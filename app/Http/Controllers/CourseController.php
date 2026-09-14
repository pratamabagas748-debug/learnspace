<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;

class CourseController extends Controller
{
    /** Halaman daftar kursus publik dengan search dan filter */
    public function index()
    {
        $query = Course::with(['category', 'instructor', 'lessons'])
            ->where('status', 'published');

        // Search
        if (request('search')) {
            $query->where('title', 'like', '%' . request('search') . '%');
        }

        // Filter kategori
        if (request('category')) {
            $query->whereHas('category', function ($q) {
                $q->where('slug', request('category'));
            });
        }

        // Filter level
        if (request('level')) {
            $query->where('level', request('level'));
        }

        $courses = $query->latest()->paginate(12)->withQueryString();
        $categories = Category::all();

        return view('courses.index', compact('courses', 'categories'));
    }

    /** Halaman detail kursus */
    public function show(Course $course)
    {
        // Hanya tampilkan kursus yang published
        abort_if(!$course->isPublished(), 404);

        $course->load(['category', 'instructor', 'lessons']);
        $isEnrolled = auth()->check() && auth()->user()->isEnrolledIn($course);

        return view('courses.show', compact('course', 'isEnrolled'));
    }
}
