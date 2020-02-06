<?php

namespace Tests;

use App\User;
use App\Role;
use App\Exceptions\Handler;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp() : void
    {
        parent::setUp();
        $this->disableExceptionHandling();
    }


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

    protected function disableExceptionHandling()
    {
        $this->oldExceptionHandler = $this->app->make(ExceptionHandler::class);
        $this->app->instance(ExceptionHandler::class, new class extends Handler {
            public function __construct() {}
            public function report(\Exception $e) {}
            public function render($request, \Exception $e) {
                throw $e;
            }
        });
    }

    protected function withExceptionHandling()
    {
        $this->app->instance(ExceptionHandler::class, $this->oldExceptionHandler);
        return $this;
    }

}
