<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;


class UserManagementTest extends TestCase
{
    use DatabaseMigrations;

    public function testUnauthenticatedUserCanNotSeeUserManagementPage()
    {
        $this->get('/admin/users')
            ->assertStatus(401);
    }

    public function testNormalUserCanNotSeeUserManagementPage()
    {
        $this->signInAs('User');
        $this->get('/admin/users')
            ->assertStatus(403);
    }

    public function testEmployeeCanNotSeeUserManagementPage()
    {
        $this->signInAs('Employee');
        $this->get('/admin/users')
            ->assertStatus(403);
    }

    public function testAdminCanSeeUserManagementPage()
    {
        $this->signInAs('Admin');
        $this->get('/admin/users')
            ->assertStatus(200)
            ->assertSee('User Management Panel');
    }
}
