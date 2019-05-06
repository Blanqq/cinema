<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class WelcomePageTest extends TestCase
{
    use DatabaseMigrations;

    public function testAnyUserCanSeeWelcomePage()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Welcome to our cinema network');
    }
      //this cant be tested now because it is transferred to vue component
      public function testUnauthorizedUserNeedToLoginOrRegister()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Login');
    }

    public function testAuthorizedUserCanSeeLinkToRegistrationService()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee($user->name);
    }
}
