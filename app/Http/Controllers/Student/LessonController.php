<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\LessonProgress;
use App\Models\Enrollment;

class LessonController extends Controller
{
    /** Tampilkan lesson untuk dipelajari */
    public function show(Lesson $lesson)
    {
        $user = auth()->user();
        $course = $lesson->course->load(['lessons', 'instructor']);

        $isEnrolled = $user->isEnrolledIn($course);

        // Minimal 3 materi pertama selalu bisa dibuka bebas
        abort_unless($isEnrolled || $lesson->isFreePreview(), 403);

        $isCompleted = $lesson->isCompletedBy($user);

        // Lesson sebelum dan sesudah untuk navigasi
        $prevLesson = $course->lessons->where('order', '<', $lesson->order)->last();
        $nextLesson = $course->lessons->where('order', '>', $lesson->order)->first();

        // Progress kursus
        $completedLessonIds = LessonProgress::where('user_id', $user->id)
            ->whereIn('lesson_id', $course->lessons->pluck('id'))
            ->pluck('lesson_id')
            ->toArray();

        return view('student.lessons.show', compact(
            'lesson', 'course', 'isCompleted', 'isEnrolled', 'prevLesson', 'nextLesson', 'completedLessonIds'
        ));
    }

    /** Tandai lesson sebagai selesai */
    public function complete(Lesson $lesson)
    {
        $user = auth()->user();
        $course = $lesson->course;

        // Jika belum enroll, arahkan untuk mendaftar terlebih dahulu agar progress tersimpan
        if (!$user->isEnrolledIn($course)) {
            return redirect()->route('student.courses.show', $course->slug)
                ->with('info', 'Silakan klik "Daftar Kursus" untuk dapat menyimpan dan mencatat progres materi Anda.');
        }

        // Simpan progress (ignore jika sudah ada - karena ada unique constraint)
        LessonProgress::firstOrCreate([
            'user_id'   => $user->id,
            'lesson_id' => $lesson->id,
        ], [
            'completed_at' => now(),
        ]);

        // Cek apakah seluruh kursus sudah selesai
        $totalLessons = $course->lessons()->count();
        $completedLessons = LessonProgress::where('user_id', $user->id)
            ->whereIn('lesson_id', $course->lessons()->pluck('id'))
            ->count();

        if ($totalLessons === $completedLessons) {
            // Update enrollment sebagai completed
            Enrollment::where('user_id', $user->id)
                ->where('course_id', $course->id)
                ->whereNull('completed_at')
                ->update(['completed_at' => now()]);

            return redirect()->route('student.courses.show', $course->slug)
                ->with('success', 'Selamat! Anda telah menyelesaikan semua materi kursus "' . $course->title . '"! 🎉');
        }

        // Lanjut ke lesson berikutnya jika ada
        $nextLesson = $course->lessons()
            ->where('order', '>', $lesson->order)
            ->first();

        if ($nextLesson) {
            return redirect()->route('student.lessons.show', $nextLesson->id)
                ->with('success', 'Materi berhasil ditandai selesai. Lanjut ke materi berikutnya!');
        }

        return redirect()->route('student.courses.show', $course->slug)
            ->with('success', 'Materi berhasil ditandai selesai.');
    }
}
