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
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        $path = $this->convertImage($request->file('img'));
        Course::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'hours'=>$request->hours,
            'price'=>$request->price,
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
            'img'=>$path,
        ]);
        return redirect()->route('courses.list');
    }

    public function edit(Course $course): View
    {
        return view('courses.edit', ['course'=>$course]);
    }

    public function update(CourseRequest $request, Course $course): RedirectResponse
    {
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($course->image);
            $path = $this->convertImage($request->file('img'));
        }

        $course->update([
            'name'=>$request->name,
            'description'=>$request->description,
            'hours'=>$request->hours,
            'price'=>$request->price,
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
            'img'=>$path ?? $course->image,
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

    private function convertImage(UploadedFile $image):string
    {
        $tempPath = $image->getRealPath();

        $src = imagecreatefromjpeg($tempPath);

        $origW = imagesx($src);
        $origH = imagesy($src);

        $maxSize = 300;

        $ratio = min($maxSize / $origW, $maxSize / $origH);

        $newW = (int)($origW * $ratio);
        $newH = (int)($origH * $ratio);

        $dst = imagecreatetruecolor($newW, $newH);

        imagecopyresampled(
            $dst,
            $src,
            0, 0,
            0, 0,
            $newW, $newH,
            $origW, $origH
        );

        $path = 'images/mpic_' . uniqid() . '.' . $image->extension();

        $absolutePath = Storage::disk('public')->path($path);

        $directory = dirname($absolutePath);

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        imagejpeg($dst, $absolutePath);

        imagedestroy($src);
        imagedestroy($dst);
        return $path;
    }
}
