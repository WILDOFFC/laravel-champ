<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index(Less): JsonResponse
    {
        $lesson = Lesson::all();

        return response()->json([
            data
        ])
    }
}
