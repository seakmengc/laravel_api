<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->can('view any course');
    }

    public function view(User $user, Course $course)
    {
        return $user->can('view course');
    }

    public function create(User $user)
    {
        return $user->can('create course');
    }

    public function update(User $user, Course $course)
    {
        return $user->can('edit course');
    }

    public function delete(User $user, Course $course)
    {
        return $user->can('delete course');
    }
}
