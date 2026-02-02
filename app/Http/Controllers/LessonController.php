<?php

namespace App\Http\Controllers;

use App\Http\Resources\LessonResource;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index($course_id): JsonResponse
    {
        $lessons = Lesson::where('course_id', $course_id)->get();

        return response()->json([
            'data' => LessonResource::collection($lessons),
        ]);
    }
}
