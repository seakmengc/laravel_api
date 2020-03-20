<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRoleValidator;
use App\Http\Resources\UserRoleCollection;
use App\Http\Resources\UserRoleResource;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Role;

class UserRoleController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', UserRole::class);

        $roles = UserRole::paginate();

        return response()->json(new UserRoleCollection($roles));
    }

    public function store(UserRoleValidator $request)
    {
        $this->authorize('create', UserRole::class);

        $user = User::findOrFail($request['user_id']);

        $user->assignRole($request['role']);

        return response()->json(['message' => 'Assign role successfully']);
    }

    public function show(UserRoleValidator $request)
    {
        $this->authorize('viewAny', UserRole::class);

        if(isset($request['user_id']))
            $userRoles = UserRole::where('model_id', $request['user_id'])->get();
        else
            $userRoles = UserRole::where('role_id', Role::findByName($request['role'])->id)->get();

        return response()->json(new UserRoleCollection($userRoles));
    }

    public function hasRole(UserRoleValidator $request)
    {
        $userRole = UserRole::where('model_id', $request['user_id'])
            ->where('role_id', Role::findByName($request['role'])->id)
            ->first();

        $this->authorize('view', $userRole);

        return response()->json(['data' => $userRole == null ? false : true]);
    }

    public function destroy(Request $request)
    {
        $userRole = UserRole::where('model_id', $request['user_id'])
            ->where('role_id', Role::findByName($request['role'])->id)
            ->first();

        $this->authorize('delete', $userRole);

        $user = User::findOrFail($request['user_id']);

        if(!$user->hasRole($request['role']))
            return response()->json(['message' => 'User does not have role'], Response::HTTP_BAD_REQUEST);

        $user->removeRole($request['role']);

        return response()->json(['message' => 'Remove role successfully']);
    }
}
