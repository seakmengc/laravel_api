<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\RolePermissionCollection;
use App\Http\Resources\RolePermissionResource;
use App\Models\RolePermission;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    public function getPermissions(Request $request)
    {
        $this->authorize('viewAny', RolePermission::class);

        $role = Role::findByName($request['role']);

        return response()->json(new RolePermissionCollection($role));
    }

    public function userHasPermission(User $user, Request $request)
    {
        $this->authorize('view', RolePermission::class);

        return response()->json(['data' => $user->can($request['permission'])]);
    }

    public function userHasAnyPermission(User $user, Request $request)
    {
        $this->authorize('view', RolePermission::class);

        foreach ($request['permissions'] as $permission)
            if($user->can($permission))
                return response()->json(['data' => true]);

        return response()->json(['data' => false]);
    }

    public function userHasAllPermissions(User $user, Request $request)
    {
        $this->authorize('view', RolePermission::class);

        foreach ($request['permissions'] as $permission)
            if(!$user->can($permission))
                return response()->json(['data' => false]);

        return response()->json(['data' => true]);
    }

    public function store(Request $request)
    {
        $this->authorize('create', RolePermission::class);

        $role = Role::findByName($request['role']);
        foreach ($request['permissions'] as $permission)
            $role->givePermissionTo($permission);

        return response()->json(['data' => $role->getPermissionNames()]);
    }

    public function update(Request $request)
    {
        $this->authorize('edit', RolePermission::class);

        $role = Role::findByName($request['role']);

        $curr_permissions = $role->getPermissionNames();

        $need_add = array_diff($request['permissions'], $curr_permissions->toArray());
        $need_delete = array_diff($curr_permissions->toArray(), $request['permissions']);

        foreach ($need_add as $permission)
            $role->givePermissionTo($permission);

        foreach ($need_delete as $permission)
            $role->revokePermissionTo($permission);

        return response()->json(new RolePermissionCollection($role));
    }

}
