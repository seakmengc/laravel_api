<?php
//
///*
//|--------------------------------------------------------------------------
//| Web Routes
//|--------------------------------------------------------------------------
//|
//| Here is where you can register web routes for your application. These
//| routes are loaded by the RouteServiceProvider within a group which
//| contains the "web" middleware group. Now create something great!
//|
//*/
//
//// Route::get('/', function () {
////     return view('welcome');
//// });
//
//Auth::routes([
//    'register' => false,
//    'verify' => false,
//    'reset' => false
//  ]);
//
//    Route::resource('users', 'UserController');
//Route::middleware(['auth'])->group(function () {
//    Route::get('/', 'UserController@index');
//
//    Route::put('/users/{id}/restore', 'UserController@restore')->name('users.restore');
//    Route::get('/users/{id}/restore', 'UserController@confirm_restore')->name('users.restore');
//
//    Route::resource('courses', 'CourseController');
//    Route::put('/courses/{id}/restore', 'CourseController@restore')->name('courses.restore');
//
//    Route::get('/user_roles/{user}/create', 'UserRoleController@create')->name('user_roles.create');
//    Route::post('/user_roles/{user}', 'UserRoleController@store')->name('user_roles.store');
//    Route::delete('/user_roles/{user}/{role}', 'UserRoleController@destroy')->name('user_roles.destroy');
//
//    Route::get('/student_courses/{user}/create', 'StudentCourseController@create')
//        ->name('student_courses.create');
//    Route::post('/student_courses/{user}', 'StudentCourseController@store')
//        ->name('student_courses.store');
//    Route::delete('/student_courses/{student_course}', 'StudentCourseController@destroy')
//        ->name('student_courses.destroy');
//});
//
//Auth::routes();
//
//Route::get('/home', 'HomeController@index')->name('home');
