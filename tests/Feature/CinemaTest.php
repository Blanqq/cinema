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

    public function testAdminCanSeeListOfAllCinemas()
    {
        $this->signInAs('Admin');
        $cinema = factory(Cinema::class)->create();
        $this->get('/cinemas/')->assertSee($cinema->name);
    }

    public function testEmployeeCanSeeListOfAllCinemas()
    {
        $this->signInAs('Employee');
        $cinema = factory(Cinema::class)->create();
        $this->get('/cinemas/')->assertSee($cinema->name);
    }

    public function testUserCanNotSeeListOfAllCinemas()
    {
        $this->signInAs('User');
        $cinema = factory(Cinema::class)->create();
        $this->get('/cinemas/')->assertForbidden(); // 403
    }

    public function testAdminCanUpdateCinemaDetails()
    {
        $this->signInAs('Admin');
        $cinema = factory(Cinema::class)->create(['street' => 'Random Street']);
        $this->get('/cinemas')->assertSee($cinema->name);

        $editedStreet = 'Edited Street';
        $editedCity = 'Edited City';

        $this->patch('/cinemas/'.$cinema->slug,['street' => $editedStreet, 'city' => $editedCity]);
        $this->get('/cinemas/'.$cinema->fresh()->slug)
            ->assertSee($editedStreet)
            ->assertDontSee($cinema->street);
    }

    public function testEmployeeCanUpdateCinemaDetails()
    {
        $this->signInAs('Employee');
        $cinema = factory(Cinema::class)->create(['street' => 'Random Street']);
        $this->get('/cinemas')->assertSee($cinema->name);

        $editedStreet = 'Edited Street';
        $editedCity = 'Edited City';

        $this->patch('/cinemas/'.$cinema->slug, ['street' => $editedStreet, 'city' => $editedCity]);
        $this->get('/cinemas/'.$cinema->fresh()->slug)
            ->assertSee($editedStreet)
            ->assertDontSee($cinema->street);
    }

    public function testUserHaveNoAccessToPatchCinemaRoute()
    {
        $this->signInAs('User');
        $cinema = factory(Cinema::class)->create();

        $editedStreet = 'Edited Street';
        $editedCity = 'Edited City';

        $this->patch('/cinemas/'.$cinema->slug, ['street' => $editedStreet, 'city' => $editedCity])
            ->assertForbidden();
    }

    public function testAdminCanDeleteCinema()
    {
        $this->signInAs('Admin');
        $cinema = factory(Cinema::class)->create();
        $this->assertDatabaseHas('cinemas', ['slug' => $cinema->slug]);

        $this->delete('/cinemas/'.$cinema->slug);
        $this->assertDatabaseMissing('cinemas', ['slug' => $cinema->slug]);
    }

    public function testEmployeeCanDeleteCinema()
    {
        $this->signInAs('Employee');
        $cinema = factory(Cinema::class)->create();
        $this->assertDatabaseHas('cinemas', ['slug' => $cinema->slug]);

        $this->delete('/cinemas/'.$cinema->slug);
        $this->assertDatabaseMissing('cinemas', ['slug' => $cinema->slug]);
    }

    public function testUserDoNotHaveAccessToDeleteCinemaRoute()
    {
        $this->signInAs('User');
        $cinema = factory(Cinema::class)->create();

        $this->delete('/cinemas/'.$cinema->slug)->assertForbidden();
    }
}
