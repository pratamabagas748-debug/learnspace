<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
        'enrolled_at',
        'completed_at',
    ];

    protected $casts = [
        'enrolled_at'  => 'datetime',
        'completed_at' => 'datetime',
    ];

    // ==========================================
    // RELATIONSHIPS
    // ==========================================

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // ==========================================
    // CERTIFICATE HELPERS
    // ==========================================

    public function isCompleted(): bool
    {
        return !is_null($this->completed_at);
    }

    public function getCertificateNumberAttribute(): string
    {
        $year = $this->completed_at ? $this->completed_at->format('Y') : date('Y');
        $padId = str_pad($this->id, 5, '0', STR_PAD_LEFT);
        $checksum = strtoupper(substr(md5($this->id . $this->user_id . $this->course_id . 'LEARNSPACE_SALT'), 0, 4));
        return "LS-CERT-{$year}-{$padId}-{$checksum}";
    }

    public static function findByCertificateNumber(string $certNumber): ?self
    {
        // Format: LS-CERT-YYYY-ID-CHECKSUM
        $parts = explode('-', $certNumber);
        if (count($parts) >= 4) {
            $id = (int) $parts[3];
            $enrollment = static::with(['user', 'course.instructor'])->find($id);
            if ($enrollment && $enrollment->certificate_number === $certNumber) {
                return $enrollment;
            }
        }
        return null;
    }
}
