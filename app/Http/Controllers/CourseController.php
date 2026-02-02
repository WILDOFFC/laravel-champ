<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CourseController extends Controller
{

    public function index(): JsonResponse
    {
        $courses = Course::paginate(5);
        return response()->json([
            'data' => CourseResource::collection($courses),
        'pagination' => [
            'total' => $courses->total(),
            'current' => $courses->currentPage(),
            'per_page' => $courses->perPage(),
            ]
            ]
        );
    }
    public function buyCourse(Course $course, CourseRequest $request): JsonResponse
    {


        return response()->json(['pay url:'], 200);
        }
}
