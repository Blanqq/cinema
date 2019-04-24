<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WelcomePageTest extends TestCase
{
    use RefreshDatabase;

    public function testAnyUserCanSeeWelcomePage()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Welcome to our cinema network');
    }
    /*  this cant be tested now because it is transferred to vue component
     * public function testUnauthorizedUserNeedToLoginOrRegister()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Please register or login to buy tickets');
    }

    public function testAuthorizedUserCanSeeLinkToRegistrationService()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Go Reserve Tickets');
    }*/
}
