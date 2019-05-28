<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class EmployeePanelTest extends TestCase
{
    use DatabaseMigrations;

    public function testAdminCanSeeLinkToEmployeePanel()
    {
        $this->signInAs('Admin');
        $response = $this->get('/');
        $response->assertSee('Employee Panel');
    }

    public function testEmployeeCantSeeLinkToEmployeePanel()
    {
        $this->signInAs('Employee');
        $response = $this->get('/');
        $response->assertSee('Employee Panel');
    }

    public function testNormalUserCantSeeLinkToEmployeePanel()
    {
        $this->signInAs('User');
        $response = $this->get('/');
        $response->assertDontSee('Employee Panel');
    }

    public function testAdminCanSeeEmployeePanelPage()
    {
        $this->signInAs('Admin');
        $this->get('/employee')->assertSee('Employee Panel')->assertStatus(200);
    }

    public function testEmployeeCanSeeEmployeePanelPage()
    {
        $this->signInAs('Admin');
        $this->get('/employee')->assertSee('Employee Panel')->assertStatus(200);
    }

    public function testNormalUserCanNotSeeEmployeePanel()
    {
        $this->signInAs('User');
        $this->get('/employee')->assertSee('insufficient privileges')
            ->assertStatus(403);
    }
}
