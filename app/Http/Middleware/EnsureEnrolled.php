<?php

namespace App\Http\Middleware;

use App\Models\Course;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureEnrolled
{
    /**
     * Pastikan student sudah enroll ke kursus sebelum mengakses lesson.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $lesson = $request->route('lesson');

        if ($lesson && !auth()->user()->isEnrolledIn($lesson->course)) {
            return redirect()->route('student.courses.show', $lesson->course->slug)
                ->with('error', 'Anda harus mendaftar ke kursus ini terlebih dahulu.');
        }

        return $next($request);
    }
}
