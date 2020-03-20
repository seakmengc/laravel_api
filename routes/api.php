<?php

use Illuminate\Http\Request;
use App\Http\Controllers;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => 'localization'], function () {
    Route::prefix('v1')->group(function() {
        Route::post('login', 'Api\v1\AuthController@login');
        Route::post('register', 'Api\v1\AuthController@register');

        Route::group(['middleware' => ['auth:api']], function () {
            Route::post('logout', 'Api\v1\AuthController@logout');

            Route::post('enroll', 'Api\v1\StudentCourseController@enroll');
            Route::delete('un_enroll', 'Api\v1\StudentCourseController@unEnroll');

            Route::get('/roles', 'Api\v1\RoleController@index');
            Route::get('/roles/{role}', 'Api\v1\RoleController@show');
            Route::post('/roles', 'Api\v1\RoleController@store');
            Route::put('/roles', 'Api\v1\RoleController@update');
            Route::delete('/roles', 'Api\v1\RoleController@destroy');

            Route::apiResource('/courses', 'Api\v1\CourseController')->except(['create', 'edit']);
            Route::apiResource('/user_roles', 'Api\v1\UserRoleController')->except(['create', 'edit', 'show', 'destroy']);
            Route::get('/user_roles/show', 'Api\v1\UserRoleController@show');
            Route::delete('/user_roles', 'Api\v1\UserRoleController@destroy');
            Route::get('/has_role', 'Api\v1\UserRoleController@hasRole');

            Route::put('/role_permissions', 'Api\v1\RolePermissionController@update');
            Route::post('/role_permissions', 'Api\v1\RolePermissionController@store');

            Route::apiResource('users', 'Api\v1\UserController')->except(['create', 'store', 'edit', 'update']);
            Route::put('/users/{user}/change_password', 'Api\v1\UserController@changePassword');

            Route::get('/users/{user}/has_permission', 'Api\v1\RolePermissionController@userHasPermission');
            Route::get('/users/{user}/has_any_permission', 'Api\v1\RolePermissionController@userHasAnyPermission');
            Route::get('/users/{user}/has_all_permissions', 'Api\v1\RolePermissionController@userHasAllPermissions');
        });
    });
});
