<?php

namespace Tests\Feature;

use App\User;
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

    public function testAdminCanSeeUserRoleManagementPanelInUserShowPage()
    {
        $user = $this->createUser();
        $this->signInAs('Admin');
        $this->get('/users/'.$user->id)
            ->assertSee($user->name)
            ->assertSee('User Roles');

    }
    public function testOtherUsersCantSeeUserRoleManagementPanelInUserShowPage()
    {
        $user = $this->createUser();
        $this->signInAs('User');
        $this->get('/users/'.$user->id)
            ->assertSee($user->name)
            ->assertDontSee('User Roles');

    }
}
