<?php

namespace App\Http\Controllers;

use App\Http\Resources\LessonResource;
use App\Models\Lesson;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index(): JsonResponse
    {
        $lessons = Lesson::all();

        return response()->json([
            'data' => LessonResource::collection($lessons),
        ]);
    }
}
