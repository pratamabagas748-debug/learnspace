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

        return view('student.dashboard', compact('stats', 'enrollments', 'continuelearning'));
    }
}
