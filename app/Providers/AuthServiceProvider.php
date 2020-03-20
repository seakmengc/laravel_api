<?php

namespace App\Providers;

use App\Models\Course;
use App\Models\RolePermission;
use App\Models\StudentCourse;
use App\Models\User;
use App\Models\UserRole;
use App\Policies\CoursePolicy;
use App\Policies\RolePermissionPolicy;
use App\Policies\RolePolicy;
use App\Policies\StudentCoursePolicy;
use App\Policies\UserPolicy;
use App\Policies\UserRolePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
use Spatie\Permission\Models\Role;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        Course::class => CoursePolicy::class,
        User::class => UserPolicy::class,
        StudentCourse::class => StudentCoursePolicy::class,
        UserRole::class => UserRolePolicy::class,
        Role::class => RolePolicy::class,
        RolePermission::class => RolePermissionPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

//        Passport::personalAccessTokensExpireIn(now()->addDays(1));

        Gate::before(function ($user, $ability) {
            // dd($user->roles);
            if($user->hasRole('super admin')) return true;
        });

        Passport::tokensExpireIn(now()->addDay());
        Passport::refreshTokensExpireIn(now()->addYears(5));
    }

}
