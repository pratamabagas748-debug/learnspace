<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'description',
        'content',
        'video_url',
        'order',
        'duration',
    ];

    // ==========================================
    // RELATIONSHIPS
    // ==========================================

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function progress()
    {
        return $this->hasMany(LessonProgress::class);
    }

    // ==========================================
    // HELPERS
    // ==========================================

    /** Cek apakah lesson sudah diselesaikan oleh user tertentu */
    public function isCompletedBy(User $user): bool
    {
        return $this->progress()->where('user_id', $user->id)->exists();
    }
}
