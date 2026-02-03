<?php

namespace App\Http\Controllers;

use App\Http\Requests\LessonRequest;
use App\Http\Resources\LessonResource;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LessonController extends Controller
{
    public function index(Course $course): JsonResponse
    {
        $lessons = $course->lessons;

        return response()->json([
            'data' => LessonResource::collection($lessons),
        ]);
    }

    public function listLessons(Lesson $lesson): View
    {
        $lessons = Lesson::all();

        return view('lessons.list', ['lessons'=>$lessons]);
    }

    public function create(): View
    {
        return view('lessons.create');
    }

    public function edit(Lesson $lesson): view
    {
        return view('lessons.edit', ['lesson'=>$lesson]);
    }

    public function store(Lesson $lesson, LessonRequest $request): RedirectResponse
    {
        Lesson::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'video_link'=>$request->video_link,
            'hours'=>$request->hours
        ]);

        return redirect()->route('lessons.list');
    }

    public function update(Lesson $lesson, LessonRequest $request): RedirectResponse
    {
        $lesson->update([
            'name'=>$request->name,
            'description'=>$request->description,
            'video_link'=>$request->video_link,
            'hours'=>$request->hours
        ]);

        return redirect()->route('lessons.list');
    }

    public function destroy(Lesson $lesson): RedirectResponse
    {
        $lesson->delete();

        return redirect()->route('lessons.list');
    }
}
