<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleValidator;
use App\Http\Resources\RoleResource;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::paginate();

        return response()->json($roles);
    }

    public function show(Role $role)
    {
        $this->authorize('view', $role);

        return response()->json(new RoleResource($role));
    }

    public function store(RoleValidator $request)
    {
        $this->authorize('create', Role::class);

        $role = Role::create($request->validated());

        return response()->json(new RoleResource($role));
    }

    public function update(RoleValidator $request)
    {
        $role = Role::findByName($request['old_name']);

        $this->authorize('edit', $role);

        $role->update($request->validated());

        return response()->json(new RoleResource($role));
    }

    public function destroy(RoleValidator $request)
    {
        $role = Role::findByName($request['name']);

        $role->delete();

        return response()->json(['message' => 'Role deleted successfully.']);
    }
}
