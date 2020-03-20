<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class UserRole extends Model
{
    protected $table = 'model_has_roles';

    public $timestamps = false;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'model_id', 'id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }
}
