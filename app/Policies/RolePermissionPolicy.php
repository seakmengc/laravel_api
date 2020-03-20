<?php

namespace App\Policies;

use App\Models\RolePermission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePermissionPolicy
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
        return $user->can('view any role_permission');
    }

    /**
     * Determine whether the user can view the role permission.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RolePermission  $rolePermission
     * @return mixed
     */
    public function view(User $user, RolePermission $rolePermission)
    {
        return $user->can('view role_permission');
    }

    /**
     * Determine whether the user can create role permissions.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create role_permission');
    }

    /**
     * Determine whether the user can update the role permission.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RolePermission  $rolePermission
     * @return mixed
     */
    public function update(User $user, RolePermission $rolePermission)
    {
        return $user->can('edit role_permission');
    }
}
