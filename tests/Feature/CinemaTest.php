<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\Cinema;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CinemaTest extends TestCase
{
    use DatabaseMigrations;

    public function testAdminCanAddNewCinema()
    {
        $this->signInAs('Admin');
        $cinema = factory(Cinema::class)->make();
        $this->post('/cinemas', $cinema->toArray());
        $this->get('/cinemas')->assertSee($cinema->name);
    }

    public function testEmployeeCanAddNewCinema()
    {
        $this->signInAs('Employee');
        $cinema = factory(Cinema::class)->make();
        $this->post('/cinemas', $cinema->toArray());
        $this->get('/cinemas')->assertSee($cinema->name);
    }

    public function testNormalUserCanNotAddNewCinema()
    {
        $this->signInAs('User');
        $cinema = factory(Cinema::class)->make();
        $this->post('/cinemas/', $cinema->toArray())->assertStatus(403);

    }
}
