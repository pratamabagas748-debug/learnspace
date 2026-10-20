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

        // Modul pembelajaran minimal 3 materi pertama selalu bisa dibuka bebas sebagai pratinjau
        if ($lesson && $lesson->isFreePreview()) {
            return $next($request);
        }

        if ($lesson && !auth()->user()->isEnrolledIn($lesson->course)) {
            return redirect()->route('student.courses.show', $lesson->course->slug)
                ->with('error', 'Anda harus mendaftar ke kursus ini terlebih dahulu untuk mengakses materi ke-' . $lesson->order . '.');
        }

        return $next($request);
    }
}
