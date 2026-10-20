<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Ambil semua enrollment student dengan data kursus
        $enrollments = $user->enrollments()
            ->with(['course.lessons', 'course.category', 'course.instructor'])
            ->latest()
            ->get();

        // Hitung statistik
        $completedEnrollments = $enrollments->filter(fn($e) => $e->completed_at !== null);
        $activeEnrollments    = $enrollments->filter(fn($e) => $e->completed_at === null);

        $stats = [
            'total_enrolled'  => $enrollments->count(),
            'total_completed' => $completedEnrollments->count(),
            'total_active'    => $activeEnrollments->count(),
        ];

        // Kursus yang baru diakses (untuk "Continue Learning")
        $continuelearning = $activeEnrollments->take(3);
// Hitung Learning Streak berdasarkan tanggal belajar
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

         return view('student.dashboard', compact(
            'stats',
            'enrollments',
            'continuelearning',
            'streak'
        ));
    }
}
