<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;

class HomeController extends Controller
{
    public function index()
    {
        $featuredCourses = Course::with(['category', 'instructor', 'lessons'])
            ->where('status', 'published')
            ->latest()
            ->take(6)
            ->get();

        $categories = Category::withCount(['publishedCourses'])
            ->take(6)
            ->get();

        return view('home.index', compact('featuredCourses', 'categories'));
    }
}