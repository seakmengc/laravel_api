<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function instructor()
    {
        return $this->belongsTo(User::class, 'taught_by', 'id');
    }

    public function students()
    {
        return $this->hasMany(StudentCourse::class);
    }

    public function getStatusAttribute()
    {
        return $this->deleted_at == null ? 'Active' : 'Deleted';
    }
}
