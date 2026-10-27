<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBadge extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'badge_key',
        'earned_at',
    ];

    protected $casts = [
        'earned_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Metadata badge (icon, nama, deskripsi)
     */
    public static function getBadgeInfo(string $key): array
    {
        $badges = [
            'first_lesson' => [
                'name'        => 'Langkah Pertama',
                'description' => 'Menyelesaikan materi pembelajaran pertama kali.',
                'icon'        => '🎯',
                'color'       => 'bg-emerald-100 text-emerald-700 border-emerald-200',
            ],
            'five_lessons' => [
                'name'        => 'Pelajar Tangguh',
                'description' => 'Menyelesaikan 5 materi pembelajaran.',
                'icon'        => '⭐',
                'color'       => 'bg-amber-100 text-amber-700 border-amber-200',
            ],
            'focus_champion' => [
                'name'        => 'Fokus Master',
                'description' => 'Menyelesaikan sesi Pomodoro fokus belajar 25 menit.',
                'icon'        => '🍅',
                'color'       => 'bg-rose-100 text-rose-700 border-rose-200',
            ],
            'streak_warrior' => [
                'name'        => 'Konsistensi Api',
                'description' => 'Menjaga streak belajar selama 3 hari berturut-turut.',
                'icon'        => '🔥',
                'color'       => 'bg-orange-100 text-orange-700 border-orange-200',
            ],
        ];

        return $badges[$key] ?? [
            'name'        => ucfirst(str_replace('_', ' ', $key)),
            'description' => 'Badge pencapaian LearnSpace.',
            'icon'        => '🏅',
            'color'       => 'bg-slate-100 text-slate-700 border-slate-200',
        ];
    }
}
