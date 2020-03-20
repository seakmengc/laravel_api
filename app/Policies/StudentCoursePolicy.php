<?php

namespace App\Policies;

use App\Models\StudentCourse;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StudentCoursePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any student courses.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->can('view any student_course');
    }

    /**
     * Determine whether the user can view the student course.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\StudentCourse  $studentCourse
     * @return mixed
     */
    public function view(User $user, StudentCourse $studentCourse)
    {
        if($user == $studentCourse->user())
            return $user->can('view own student_course');

        return $user->can('view student_course');
    }

    /**
     * Determine whether the user can create student courses.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create student_course');
    }

    /**
     * Determine whether the user can update the student course.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\StudentCourse  $studentCourse
     * @return mixed
     */
    public function update(User $user, StudentCourse $studentCourse)
    {
        return $user->can('edit student_course');
    }

    /**
     * Determine whether the user can delete the student course.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\StudentCourse  $studentCourse
     * @return mixed
     */
    public function delete(User $user, StudentCourse $studentCourse)
    {
        if($user == $studentCourse->user())
            return $user->can('delete own student_course');

        return $user->can('delete student_course');
    }
}
