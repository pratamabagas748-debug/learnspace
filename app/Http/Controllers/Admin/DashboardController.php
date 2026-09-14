<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users'       => User::count(),
            'total_students'    => User::where('role', 'student')->count(),
            'total_instructors' => User::where('role', 'instructor')->count(),
            'total_courses'     => Course::count(),
            'total_enrollments' => Enrollment::count(),
        ];

        $latestCourses = Course::with(['instructor', 'category'])
            ->latest()->take(5)->get();

        $latestUsers = User::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'latestCourses', 'latestUsers'));
    }
}
