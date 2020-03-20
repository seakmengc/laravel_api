<?php

namespace App\Policies;

use App\Models\RolePermission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Models\Role;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any role permissions.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->can('view any role');
    }

    /**
     * Determine whether the user can view the role permission.
     *
     * @param \App\Models\User $user
     * @param Role $role
     * @return mixed
     */
    public function view(User $user, Role $role)
    {
        return $user->can('view role');
    }

    /**
     * Determine whether the user can create role permissions.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create role');
    }

    /**
     * Determine whether the user can update the role permission.
     *
     * @param \App\Models\User $user
     * @param Role $role
     * @return mixed
     */
    public function update(User $user, Role $role)
    {
        return $user->can('edit role');
    }
}
