<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $used = $this->username($request);

        $validator = Validator::make($request->all(), [
           "{$used['var']}" => "required|string|max:{$used['max']}"
                                    . ($used['var'] == 'email' ? '|email' : ''),
            "password" => "required|string|max:60"
        ]);

        if($validator->fails())
            return $validator->errors()->toJson();

        if(!auth()->attempt($validator->validated()))
            return response()->json(['message' => 'Invalid login credentials'], Response::HTTP_UNAUTHORIZED);

        $access_token = auth()->user()->createToken('Access Token')->accessToken;

        return response()->json(['user' => new UserResource(auth()->user()), 'accessToken' => $access_token]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => "required|max:50|email|unique:users",
            "username" => "required|string|max:30|unique:users",
            "phone_number" => "required|string|max:15",
            "password" => "required|confirmed"
        ]);

        if($validator->fails())
            return $validator->errors()->toJson();

        $data = $validator->validated();
        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        return response()->json(['user' => new UserResource($user)], Response::HTTP_CREATED);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json(['message' => 'logged out'], 200);
    }

    public function username(Request $request)
    {
        if(isset($request['username'])) return ['var' => 'username', 'max' => 30];
        elseif(isset($request['email'])) return ['var' => 'email', 'max' => 50];
        else return ['var' => 'phone_number', 'max' => 15];
    }
}
