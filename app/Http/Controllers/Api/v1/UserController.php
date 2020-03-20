<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserValidator;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', User::class);

        $users = User::paginate();

        return response()->json($users);
    }

    public function changePassword(User $user, UserValidator $request)
    {
        $this->authorize('edit', User::class);

        if(!password_verify($request['old_password'], $user['password']))
            return response()->json(['message' => 'Old Password is not match.'], Response::HTTP_BAD_REQUEST);

        $user->update(['password' => $request->validated()['password']]);

        return response()->json(new UserResource($user));
    }

    public function show(User $user)
    {
        $this->authorize('view', $user);

        return response()->json(new UserResource($user));
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', User::class);

        $user->delete();

        return response()->json(['message' => 'User deleted'], 200);
    }
}
