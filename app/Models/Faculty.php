<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faculty extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function departments()
    {
        return $this->hasMany(Department::class)->withTrashed();
    }

    public function getStatusAttribute()
    {
        return $this->deleted_at == null ? 'Active' : 'Deleted';
    }
}
