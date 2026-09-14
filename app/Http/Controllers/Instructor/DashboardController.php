<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $courses = $user->courses()->with(['category', 'lessons', 'enrollments'])->get();

        $stats = [
            'total_courses'     => $courses->count(),
            'total_students'    => Enrollment::whereIn('course_id', $courses->pluck('id'))->count(),
            'total_lessons'     => $courses->sum(fn($c) => $c->lessons->count()),
        ];

        return view('instructor.dashboard', compact('stats', 'courses'));
    }
}
