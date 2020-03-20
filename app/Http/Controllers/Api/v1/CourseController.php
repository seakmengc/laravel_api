<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseValidator;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Course::class);

        $courses = Course::paginate();

        return response()->json($courses);
    }

    public function store(CourseValidator $request)
    {
        $this->authorize('create', Course::class);

        $course = Course::create($request->validated());

        return response()->json(new CourseResource($course));
    }

    public function update(Course $course, CourseValidator $request)
    {
        $this->authorize('edit', Course::class);

        $course->update($request->validated());

        return response()->json(new CourseResource($course));
    }

    public function destroy(Course $course)
    {
        $this->authorize('delete', Course::class);

        $course->delete();

        return response()->json(['message' => 'Course deleted']);
    }

    public function show(Course $course)
    {
        $this->authorize('view', $course);

        return response()->json(new CourseResource($course));
    }


}
