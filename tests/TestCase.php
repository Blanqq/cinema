<?php

namespace Tests;

use App\User;
use App\Role;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;


    protected function signInAs($roleForUser = 'User', $user = null, $role = null)
    {
        $user = $user ?: factory(User::class)->create();
        $role = $role ?: factory(Role::class)->create(['name' => $roleForUser]);
        $user->roles()->attach($role);
        $this->actingAs($user);
        return $this;
    }

    protected function createUser($roleForUser = 'User')
    {
        $user = factory(User::class)->create();
        $role = factory(Role::class)->create();
        $user->roles()->attach($role);
        return $user;
    }
}
