<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Spatie\Permission\Models\Role;

class UserRoleCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if(isset($request['user_id'])) {
            $role_names = array();
            foreach ($this as $obj)
                $role_names[] = $obj->role->name;

            return [
                'data' => [
                    'roles' => $role_names,
                    'user' => $request['user_id']
                ]
            ];
        } elseif (isset($request['role'])) {
            $users_username = array();
            foreach ($this as $obj)
                $users_username[] = ['id' => $obj->user->id, 'username' => $obj->user->username];

            return [
                'data' => [
                    'roles' => $request['role'],
                    'user' => $users_username
                ]
            ];
        } else {
            return [
                'data' => $this->collection->transform(function ($userRole) {
                    return new UserRoleResource($userRole);
                }),
            ];
        }

    }
}
