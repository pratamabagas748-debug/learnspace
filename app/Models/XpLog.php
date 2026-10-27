<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class XpLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'points',
        'source',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Helper untuk mencatat XP baru dan otomatis menambah xp_points di tabel users
     */
    public static function award(User $user, int $points, string $source, ?string $description = null): self
    {
        $log = self::create([
            'user_id'     => $user->id,
            'points'      => $points,
            'source'      => $source,
            'description' => $description,
        ]);

        $user->increment('xp_points', $points);

        return $log;
    }
}
