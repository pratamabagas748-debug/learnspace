<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserQuest;
use App\Models\XpLog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeaderboardController extends Controller
{
    /**
     * Halaman Utama Leaderboard & Liga Mingguan
     */
    public function index()
    {
        $user = auth()->user();

        // Data Leaderboard Mingguan & Sepanjang Waktu
        $weeklyLeaderboard = self::getWeeklyLeaderboard();
        $allTimeLeaderboard = self::getAllTimeLeaderboard();

        // Hitung peringkat user saat ini
        $userRank = self::getUserWeeklyRank($user->id);

        // Hitung sisa waktu hingga reset mingguan (setiap Senin 00:00)
        $endOfWeek = now()->endOfWeek();
        $diff = now()->diff($endOfWeek);
        $timeRemaining = sprintf('%d hari %d jam', $diff->days, $diff->h);

        // Data Quests Harian
        $streak = self::calculateStreak($user);
        $quests = self::getDailyQuestsData($user, $streak);

        // Tentukan Liga saat ini
        $league = self::getLeagueTier($user->xp_points ?? 0);

        return view('student.leaderboard', compact(
            'weeklyLeaderboard',
            'allTimeLeaderboard',
            'userRank',
            'timeRemaining',
            'quests',
            'league',
            'streak'
        ));
    }

    /**
     * Klaim reward XP dari Misi Harian yang sudah selesai
     */
    public function claimQuest(Request $request): JsonResponse
    {
        $request->validate([
            'quest_key' => 'required|string|in:daily_lesson,daily_focus,daily_streak',
        ]);

        $user = auth()->user();
        $questKey = $request->input('quest_key');
        $today = now()->toDateString();

        $streak = self::calculateStreak($user);
        $quests = self::getDailyQuestsData($user, $streak);

        if (!isset($quests[$questKey])) {
            return response()->json(['success' => false, 'message' => 'Misi tidak valid.'], 400);
        }

        $quest = $quests[$questKey];

        // Pastikan misi sudah selesai
        if (!$quest['completed']) {
            return response()->json(['success' => false, 'message' => 'Misi ini belum terselesaikan.'], 400);
        }

        // Cek apakah sudah pernah diklaim hari ini
        $alreadyClaimed = UserQuest::where('user_id', $user->id)
            ->where('quest_key', $questKey)
            ->where('quest_date', $today)
            ->where('claimed', true)
            ->exists();

        if ($alreadyClaimed) {
            return response()->json(['success' => false, 'message' => 'Reward misi ini sudah pernah diklaim hari ini.'], 400);
        }

        // Simpan klaim misi
        UserQuest::updateOrCreate(
            [
                'user_id'    => $user->id,
                'quest_key'  => $questKey,
                'quest_date' => $today,
            ],
            [
                'claimed'    => true,
                'claimed_at' => now(),
            ]
        );

        // Catat penambahan XP
        XpLog::award($user, $quest['reward_xp'], 'daily_quest', 'Reward Misi: ' . $quest['title']);

        return response()->json([
            'success'   => true,
            'earned_xp' => $quest['reward_xp'],
            'total_xp'  => (int) $user->fresh()->xp_points,
            'message'   => "Selamat! Kamu berhasil mengklaim +{$quest['reward_xp']} XP dari misi '{$quest['title']}'!",
        ]);
    }

    /**
     * Ambil 10 teratas leaderboard mingguan
     */
    public static function getWeeklyLeaderboard(int $limit = 10)
    {
        $startOfWeek = now()->startOfWeek();

        $weeklySub = DB::table('xp_logs')
            ->select('user_id', DB::raw('SUM(points) as weekly_points'))
            ->where('created_at', '>=', $startOfWeek)
            ->groupBy('user_id');

        return User::query()
            ->leftJoinSub($weeklySub, 'weekly_xp', function ($join) {
                $join->on('users.id', '=', 'weekly_xp.user_id');
            })
            ->select('users.*', DB::raw('COALESCE(weekly_xp.weekly_points, 0) as weekly_points'))
            ->where('users.role', 'student')
            ->orderByDesc('weekly_points')
            ->orderByDesc('xp_points')
            ->limit($limit)
            ->get();
    }

    /**
     * Ambil 10 teratas leaderboard all-time
     */
    public static function getAllTimeLeaderboard(int $limit = 10)
    {
        return User::where('role', 'student')
            ->orderByDesc('xp_points')
            ->limit($limit)
            ->get();
    }

    /**
     * Dapatkan peringkat mingguan user
     */
    public static function getUserWeeklyRank(int $userId): int
    {
        $leaders = self::getWeeklyLeaderboard(100);
        foreach ($leaders as $index => $u) {
            if ($u->id === $userId) {
                return $index + 1;
            }
        }
        return count($leaders) + 1;
    }

    /**
     * Ambil data status misi harian siswa
     */
    public static function getDailyQuestsData(User $user, int $streak): array
    {
        $today = now()->toDateString();
        $startOfToday = now()->startOfDay();

        // 1. Cek apakah ada materi yang selesai hari ini
        $lessonsTodayCount = $user->lessonProgress()
            ->where('completed_at', '>=', $startOfToday)
            ->count();

        // 2. Cek apakah ada sesi Pomodoro selesai hari ini
        $pomodoroTodayCount = XpLog::where('user_id', $user->id)
            ->where('source', 'pomodoro_session')
            ->where('created_at', '>=', $startOfToday)
            ->count();

        // 3. Status klaim hari ini
        $claimedKeys = UserQuest::where('user_id', $user->id)
            ->where('quest_date', $today)
            ->where('claimed', true)
            ->pluck('quest_key')
            ->toArray();

        $definitions = UserQuest::getDailyQuestsDefinition();

        $results = [];

        // Quest 1: Materi
        $lessonTarget = $definitions['daily_lesson']['target'];
        $lessonCurrent = min($lessonsTodayCount, $lessonTarget);
        $results['daily_lesson'] = array_merge($definitions['daily_lesson'], [
            'current'   => $lessonCurrent,
            'completed' => $lessonCurrent >= $lessonTarget,
            'claimed'   => in_array('daily_lesson', $claimedKeys),
        ]);

        // Quest 2: Focus
        $focusTarget = $definitions['daily_focus']['target'];
        $focusCurrent = min($pomodoroTodayCount, $focusTarget);
        $results['daily_focus'] = array_merge($definitions['daily_focus'], [
            'current'   => $focusCurrent,
            'completed' => $focusCurrent >= $focusTarget,
            'claimed'   => in_array('daily_focus', $claimedKeys),
        ]);

        // Quest 3: Streak
        $streakTarget = $definitions['daily_streak']['target'];
        $streakCurrent = min($streak > 0 ? 1 : 0, $streakTarget);
        $results['daily_streak'] = array_merge($definitions['daily_streak'], [
            'current'   => $streakCurrent,
            'completed' => $streakCurrent >= $streakTarget,
            'claimed'   => in_array('daily_streak', $claimedKeys),
        ]);

        return $results;
    }

    /**
     * Helper penentu tingkatan Liga (Duolingo style)
     */
    public static function getLeagueTier(int $xp): array
    {
        if ($xp >= 600) {
            return [
                'name'  => 'Liga Berlian',
                'badge' => '💎',
                'color' => 'from-cyan-500 to-blue-600',
                'bg'    => 'bg-cyan-50 border-cyan-200 text-cyan-800',
                'next'  => null,
                'min'   => 600,
            ];
        }
        if ($xp >= 300) {
            return [
                'name'  => 'Liga Emas',
                'badge' => '🥇',
                'color' => 'from-amber-400 to-yellow-500',
                'bg'    => 'bg-amber-50 border-amber-200 text-amber-800',
                'next'  => 600,
                'min'   => 300,
            ];
        }
        if ($xp >= 100) {
            return [
                'name'  => 'Liga Perak',
                'badge' => '🥈',
                'color' => 'from-slate-300 to-slate-400',
                'bg'    => 'bg-slate-100 border-slate-200 text-slate-800',
                'next'  => 300,
                'min'   => 100,
            ];
        }

        return [
            'name'  => 'Liga Perunggu',
            'badge' => '🥉',
            'color' => 'from-amber-700 to-amber-800',
            'bg'    => 'bg-orange-50 border-orange-200 text-orange-800',
            'next'  => 100,
            'min'   => 0,
        ];
    }

    /**
     * Hitung streak belajar aktif
     */
    public static function calculateStreak(User $user): int
    {
        $completedDates = $user->lessonProgress()
            ->whereNotNull('completed_at')
            ->get()
            ->map(fn ($progress) => $progress->completed_at->toDateString())
            ->unique()
            ->sortDesc()
            ->values();

        $today = now()->toDateString();
        $yesterday = now()->subDay()->toDateString();

        $streak = 0;

        if ($completedDates->contains($today) || $completedDates->contains($yesterday)) {
            $expectedDate = $completedDates->contains($today)
                ? now()->startOfDay()
                : now()->subDay()->startOfDay();

            foreach ($completedDates as $date) {
                if ($date !== $expectedDate->toDateString()) {
                    break;
                }

                $streak++;
                $expectedDate->subDay();
            }
        }

        return $streak;
    }
}
