<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentCourse extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id', 'id')->withTrashed();
    }

    public function course()
    {
        return $this->belongsTo(Course::class)->withTrashed();
    }
}
