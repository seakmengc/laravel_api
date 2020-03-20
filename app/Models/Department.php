<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class)->withTrashed();
    }

    public function getStatusAttribute()
    {
        return $this->deleted_at == null ? 'Active' : 'Deleted';
    }

    public function courses()
    {
        return $this->hasMany(Course::class)->withTrashed();
    }
}
