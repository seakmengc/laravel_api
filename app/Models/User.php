<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, SoftDeletes, HasRoles;

    protected $guarded = [];

    protected $guard_name = 'api';

    public function courses_taking()
    {
        return $this->hasMany(StudentCourse::class, 'student_id', 'id');
    }

    public function courses_teaching()
    {
        return $this->hasMany(Course::class, 'taught_by', 'id');
    }

    public function getStatusAttribute()
    {
        return $this->deleted_at == null ? 'Active' : 'Deleted';
    }
}
