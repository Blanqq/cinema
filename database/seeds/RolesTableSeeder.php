<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = new Role();
        $role1->name = 'Admin';
        $role1->save();

        $role2 = new Role();
        $role2->name = 'Employee';
        $role2->save();

        $role3 = new Role();
        $role3->name = 'User';
        $role3->save();
    }
}
