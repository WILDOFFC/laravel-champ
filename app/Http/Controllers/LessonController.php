<?php

namespace App\Http\Controllers;

use App\Http\Resources\LessonResource;
use App\Models\Course;
use Illuminate\Http\JsonResponse;

class LessonController extends Controller
{
    public function index(Course $course): JsonResponse
    {
        $lessons = $course->lessons;

        return response()->json([
            'data' => LessonResource::collection($lessons),
        ]);
    }
}
