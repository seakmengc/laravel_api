<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UserSeeder::class);
         $this->call(FacultySeeder::class);
         $this->call(DepartmentSeeder::class);
         $this->call(CourseSeeder::class);

        //INSERT DATA
        $roles = ['super admin', 'admin', 'student', 'instructor'];
        foreach ($roles as $role) {
            \Illuminate\Support\Facades\DB::table('roles')->insert([
                'name' => $role,
                'guard_name' => 'api'
            ]);
        }
        //

        $types = ['user', 'course', 'role', 'user_role', 'role_permission', 'student_course'];
        $permissions = ['view', 'create', 'delete', 'edit'];
        foreach ($types as $type)
            foreach ($permissions as $p) {
                \Illuminate\Support\Facades\DB::table('permissions')->insert([
                    'name' => $p . ' ' . $type,
                    'guard_name' => 'api'
                ]);

                if($p !== 'create')
                    \Illuminate\Support\Facades\DB::table('permissions')->insert([
                        'name' => $p . ' own ' . $type,
                        'guard_name' => 'api'
                    ]);
            }

        foreach ($types as $type) {
            \Illuminate\Support\Facades\DB::table('permissions')->insert([
                'name' => 'view any ' . $type,
                'guard_name' => 'api'
            ]);
        }



//        \Illuminate\Support\Facades\DB::table('model_has_roles')->insert([
//            'role_id' => 1,
//            'model_id' => 1,
//            'model_type' => 'App/Models/User'
//        ]);

    }
}
