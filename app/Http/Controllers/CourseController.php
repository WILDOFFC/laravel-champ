<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use App\Models\Order;
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

    public function buyCourse(Request $request, Course $course): JsonResponse
    {
        if (now()->gt($course->start_date)) {
            return response()->json([
                'message' => 'Invalid data',
                'errors' => [
                    'course_id' => ['Invalid data']
                ],
            ]);
        }

        Order::create([
            'user_id' => $request->user()->id,
            'course_id' => $course->id,
            'status' => StatusEnum::PENDING,
        ]);

        return response()->json(['pay_url' => 'pay_' . uniqid()]);
    }
}
