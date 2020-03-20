<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentCourseValidator;
use App\Http\Resources\StudentCourseResource;
use App\Models\StudentCourse;

class StudentCourseController extends Controller
{
    public function enroll(StudentCourseValidator $request)
    {
        $this->authorize('create', StudentCourse::class);

        $stu_course = StudentCourse::create($request->validated());

        return response()->json(new StudentCourseResource($stu_course));
    }

    public function unEnroll(StudentCourseValidator $request)
    {
        $this->authorize('delete', StudentCourse::class);

        StudentCourse::where('student_id', $request->validated()['student_id'])
            ->where('course_id', $request->validated()['course_id'])
            ->delete();

        return response()->json(['message' => 'Un-Enroll successfully']);
    }
}
