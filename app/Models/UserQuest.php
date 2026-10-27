<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserQuest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'quest_key',
        'quest_date',
        'claimed',
        'claimed_at',
    ];

    protected $casts = [
        'quest_date' => 'date',
        'claimed'    => 'boolean',
        'claimed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Definisi daftar misi harian beserta target dan reward XP
     */
    public static function getDailyQuestsDefinition(): array
    {
        return [
            'daily_lesson' => [
                'title'       => 'Pelajar Aktif',
                'description' => 'Selesaikan minimal 1 materi hari ini',
                'reward_xp'   => 15,
                'icon'        => '📖',
                'target'      => 1,
            ],
            'daily_focus' => [
                'title'       => 'Fokus Produktif',
                'description' => 'Jalankan 1 sesi Pomodoro fokus belajar (25 menit)',
                'reward_xp'   => 10,
                'icon'        => '🍅',
                'target'      => 1,
            ],
            'daily_streak' => [
                'title'       => 'Konsistensi Juara',
                'description' => 'Pertahankan streak belajarmu hari ini',
                'reward_xp'   => 10,
                'icon'        => '🔥',
                'target'      => 1,
            ],
        ];
    }
}
