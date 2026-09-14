<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function create(Course $course)
    {
        abort_if($course->instructor_id !== auth()->id(), 403);

        return view('instructor.lessons.create', compact('course'));
    }

    public function store(Request $request, Course $course)
    {
        abort_if($course->instructor_id !== auth()->id(), 403);

        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'content'     => ['nullable', 'string'],
            'video_url'   => ['nullable', 'url'],
            'order'       => ['required', 'integer', 'min:1'],
            'duration'    => ['nullable', 'integer', 'min:1'],
        ]);

        $validated['course_id'] = $course->id;

        Lesson::create($validated);

        return redirect()->route('instructor.courses.index')
            ->with('success', 'Materi berhasil ditambahkan!');
    }

    public function edit(Lesson $lesson)
    {
        abort_if($lesson->course->instructor_id !== auth()->id(), 403);

        $course = $lesson->course;
        return view('instructor.lessons.edit', compact('lesson', 'course'));
    }

    public function update(Request $request, Lesson $lesson)
    {
        abort_if($lesson->course->instructor_id !== auth()->id(), 403);

        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'content'     => ['nullable', 'string'],
            'video_url'   => ['nullable', 'url'],
            'order'       => ['required', 'integer', 'min:1'],
            'duration'    => ['nullable', 'integer', 'min:1'],
        ]);

        $lesson->update($validated);

        return redirect()->route('instructor.courses.index')
            ->with('success', 'Materi berhasil diperbarui!');
    }

    public function destroy(Lesson $lesson)
    {
        abort_if($lesson->course->instructor_id !== auth()->id(), 403);

        $lesson->delete();

        return back()->with('success', 'Materi berhasil dihapus.');
    }
}
