<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with(['instructor', 'category', 'enrollments'])
            ->latest()
            ->paginate(15);

        return view('admin.courses.index', compact('courses'));
    }

    public function show(Course $course)
    {
        $course->load(['instructor', 'category', 'lessons', 'students']);
        return view('admin.courses.show', compact('course'));
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('admin.courses.index')
            ->with('success', 'Kursus berhasil dihapus.');
    }
}
