<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Movie;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = Role::where('name', 'User')->first();
        $role_employee = Role::where('name', 'Employee')->first();
        $role_admin = Role::where('name', 'Admin')->first();

        $admin = new User();
        $admin->name = 'Admin';
        $admin->email = 'admin@example.com';
        $admin->password = bcrypt('admin');
        $admin->save();
        $admin->roles()->attach($role_admin);

        $employee = new User();
        $employee->name = 'Employee';
        $employee->email = 'employee@example.com';
        $employee->password = bcrypt('employee');
        $employee->save();
        $employee->roles()->attach($role_employee);
        $employee->roles()->attach($role_user);

        $user = new User();
        $user->name = 'User';
        $user->email = 'user@example.com';
        $user->password = bcrypt('user');
        $user->email_verified_at = now();
        $user->save();
        $user->roles()->attach($role_user);



        factory(User::class, 10)->create()->each(function($user){
            $role_user = Role::where('name', 'User')->first();
            $user->roles()->attach($role_user);
        });
    }
}
