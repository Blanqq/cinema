<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrationTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testNotLoggedInUserCanCreateAccount()
    {
        $this->assertDatabaseMissing('users', ['name' => 'JohnJohn',
                                        'email' => 'johnjohn@example.com'
                                        ]);

        $this->post('/register', [
            'name' => 'JohnJohn',
            'email' => 'johnjohn@example.com',
            'password' => 'john123456789',
            'password_confirmation' => 'john123456789'
        ]);

        $this->assertDatabaseHas('users', ['name' => 'JohnJohn',
                                        'email' => 'johnjohn@example.com'
                                        ]);
    }
}
