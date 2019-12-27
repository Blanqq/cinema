<?php

namespace Tests\Feature;

use App\Role;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;


class UserManagementTest extends TestCase
{
    use DatabaseMigrations;

    public function testUnauthenticatedUserCanNotSeeUserManagementPage()
    {
        $this->get('/users')
            ->assertStatus(401);
    }

    public function testNormalUserCanNotSeeUserManagementPage()
    {
        $this->signInAs('User');
        $this->get('/users')
            ->assertStatus(403);
    }

    public function testEmployeeCanNotSeeUserManagementPage()
    {
        $this->signInAs('Employee');
        $this->get('/users')
            ->assertStatus(403);
    }

    public function testAdminCanSeeUserManagementPage()
    {
        $this->signInAs('Admin');
        $this->get('/users')
            ->assertStatus(200)
            ->assertSee('User Management Panel');
    }

    public function testAdminCanSeeUserRoleManagementPanelInUserShowPage()
    {
        $user = $this->createUser();
        $this->signInAs('Admin');
        $this->get('/users/'.$user->name)
            ->assertSee($user->name)
            ->assertSee('User Roles');

    }
    public function testOtherUsersCantSeeUserRoleManagementPanelInUserShowPage()
    {
        $user = $this->createUser();
        $this->signInAs('User');
        $this->get('/users/'.$user->name)
            ->assertSee($user->name)
            ->assertDontSee('User Roles');
    }

    public function testUserCantManageUserRoles()
    {
        $user = $this->createUser();
        factory(Role::class)->create(['name' => 'Employee']);
        $this->signInAs('User');
        $this->patch('/roles_users/update/'.$user->name, ['user_roles' => ['Employee']])
            ->assertSee('insufficient privileges')
            ->assertStatus(403);
    }
    public function testEmployeeCantManageUserRoles()
    {
        $user = $this->createUser();
        $this->signInAs('Employee');

        $this->patch('/roles_users/update/'.$user->name, ['user_roles' => ['Employee']])
            ->assertSee('insufficient privileges')
            ->assertStatus(403);
    }

    public function testAdminCanManageUserRoles()
    {
        $user = $this->createUser();
        $role = factory(Role::class)->create(['name' => 'Employee']);
        $this->signInAs('Admin');
        $this->patch('/roles_users/update/'.$user->name, ['user_roles' => ['Employee']]);
        $this->assertDatabaseHas('role_user', ['user_id' => $user->id, 'role_id' => $role->id]);
    }
}
