<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Http\Requests\CourseRequest;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use App\Models\Order;
use App\Models\UserCourse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function listCourses(): View
    {
        $courses = Course::paginate(5);


        return view('courses.list', ['courses' => $courses]);
    }

    public function create(): View
    {
        return view('courses.create');
    }

    public function store(CourseRequest $request): RedirectResponse
    {
        Course::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'hours'=>$request->hours,
            'price'=>$request->price,
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
            'img'=>$request->img
        ]);

        return redirect()->route('courses.list');
    }

    public function edit(Course $course): View
    {
        return view('courses.edit', ['course'=>$course]);
    }

    public function update(CourseRequest $request, Course $course): RedirectResponse
    {
        $course->update([
            'name'=>$request->name,
            'description'=>$request->description,
            'hours'=>$request->hours,
            'price'=>$request->price,
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
            'img'=>$request->img
        ]);

        return redirect()->route('courses.list');
    }

    public function destroy(Course $course): RedirectResponse
    {
        $course->delete();

        return redirect()->route('courses.destroy');
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
