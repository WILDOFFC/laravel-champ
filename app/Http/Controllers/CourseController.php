<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use App\Models\UserCourse;
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

    public function buyCourse(Request $request, $course_id): JsonResponse
    {
        $user_courses =UserCourse::create([
            'user_id'=>$request->user_id,
            'course_id'=>$request->course_id,
        ]);

        return response()->json(['pay_url', 'url.com']);
    }
}
