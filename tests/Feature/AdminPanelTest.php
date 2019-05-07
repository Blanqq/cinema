<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminPanelTest extends TestCase
{
    use DatabaseMigrations;

    public function testAdminCanSeeLinkToAdminPanel()
    {
        $this->signInAs('Admin');
        $response = $this->get('/');
        $response->assertSee('Admin Panel');
    }

    public function testEmployeeCantSeeLinkToAdminPanel()
    {
        $this->signInAs('Employee');
        $response = $this->get('/');
        $response->assertDontSee('Admin Panel');
    }

    public function testNormalUserCantSeeLinkToAdminPanel()
    {
        $this->signInAs('User');
        $response = $this->get('/');
        $response->assertDontSee('Admin Panel');
    }

    public function testAdminCanVisitAdminPanel()
    {
        $this->signInAs('Admin');
        $this->get('/admin')->assertSee('Admin Panel')->assertStatus(200);
    }

    public function testEmployeeCanNotVisitAdminPanel()
    {
        $this->signInAs('Employee');
        $this->get('/admin')->assertSee('insufficient privileges')
            ->assertStatus(403);
    }

    public function testNormalUserCanNotVisitAdminPanel()
    {
        $this->signInAs('Employee');
        $this->get('/admin')->assertSee('insufficient privileges')
            ->assertStatus(403);
    }

    public function testUnauthorizedUserCantSeeAdminPage()
    {
        $this->get('/admin')->assertSee('not logged in')
            ->assertStatus(401);
    }
}
