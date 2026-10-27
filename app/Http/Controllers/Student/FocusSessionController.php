<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\UserBadge;
use App\Models\XpLog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FocusSessionController extends Controller
{
    /**
     * Catat penyelesaian sesi fokus Pomodoro (25 menit)
     */
    public function complete(Request $request, Lesson $lesson): JsonResponse
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Unauthenticated'], 401);
        }

        // Catat dan beri bonus 5 XP untuk setiap sesi fokus 25 menit
        XpLog::award(
            $user,
            5,
            'pomodoro_session',
            'Sesi Fokus Pomodoro 25 menit: ' . $lesson->title
        );

        // Cek dan berikan badge 'focus_champion' jika belum punya
        $badgeAwarded = false;
        $hasBadge = DB::table('user_badges')
            ->where('user_id', $user->id)
            ->where('badge_key', 'focus_champion')
            ->exists();

        if (!$hasBadge) {
            DB::table('user_badges')->insert([
                'user_id'    => $user->id,
                'badge_key'  => 'focus_champion',
                'earned_at'  => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $badgeAwarded = true;
        }

        return response()->json([
            'success'       => true,
            'earned_xp'     => 5,
            'total_xp'      => (int) $user->fresh()->xp_points,
            'badge_awarded' => $badgeAwarded,
            'badge_info'    => $badgeAwarded ? UserBadge::getBadgeInfo('focus_champion') : null,
            'message'       => 'Luar biasa! Kamu menyelesaikan 25 menit sesi fokus belajar dan mendapatkan +5 XP!',
        ]);
    }
}
