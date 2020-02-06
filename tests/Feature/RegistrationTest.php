<?php

namespace Tests\Feature;

use App\Rules\Recaptcha;
use App\User;
use Tests\TestCase;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrationTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp() : void
    {
        parent::setUp();

        // for every request recaptcha will pass true
        app()->singleton(Recaptcha::class, function () {
            return \Mockery::mock(Recaptcha::class, function ($m) {
                $m->shouldReceive('passes')->andReturn(true);
            });
        });
    }

    public function testNotLoggedInUserCanCreateAccount()
    {
        $this->assertDatabaseMissing('users', ['name' => 'JohnJohn',
                                        'email' => 'johnjohn@example.com'
                                        ]);

        $this->post('/register', [
            'name' => 'JohnJohn',
            'email' => 'johnjohn@example.com',
            'password' => 'john123456789',
            'password_confirmation' => 'john123456789',
            'g-recaptcha-response' => 'token'
        ]);

        $this->assertDatabaseHas('users', ['name' => 'JohnJohn',
                                        'email' => 'johnjohn@example.com'
                                        ]);
    }
    public function testRegisteringProcessRequiresRecaptcha()
    {
        unset(app()[Recaptcha::class]);
        $this->withExceptionHandling();
        $this->post('/register', [
            'name' => 'JohnJohn',
            'email' => 'johnjohn@example.com',
            'password' => 'john123456789',
            'password_confirmation' => 'john123456789',
            'g-recaptcha-response' => 'token'
        ])->assertSessionHasErrors('g-recaptcha-response');

    }
}
