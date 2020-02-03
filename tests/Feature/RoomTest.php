<?php

namespace Tests\Feature;

use App\Cinema;
use App\Room;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoomTest extends TestCase
{
    use DatabaseMigrations;

    public function testAdminCanCreateNewRoom()
    {
        $cinema = factory(Cinema::class)->create();
        $room = factory(Room::class)->make(['cinema_id' => $cinema->id]);
        $this->signInAs('Admin');
        $this->post('/cinemas/'. $cinema->slug.'/rooms/', $room->toArray());
        $this->get('/cinemas/'. $cinema->slug)->assertSee($room->name);
    }

    public function testEmployeeCanCreateNewRoom()
    {
        $cinema = factory(Cinema::class)->create();
        $room = factory(Room::class)->make(['cinema_id' => $cinema->id]);
        $this->signInAs('Employee');
        $this->post('/cinemas/'. $cinema->slug.'/rooms/', $room->toArray());
        $this->get('/cinemas/'. $cinema->slug)->assertSee($room->name);
    }

    public function testNormalUserCanNotAddNewRoom()
    {
        $cinema = factory(Cinema::class)->create();
        $room = factory(Room::class)->make(['cinema_id' => $cinema->id]);
        $this->signInAs('User');
        $this->post('/cinemas/'. $cinema->slug.'/rooms/', $room->toArray())
            ->assertStatus(403);
    }

    public function testAdminCanDeleteRoom()
    {
        $cinema = factory(Cinema::class)->create();
        $room = factory(Room::class)->create(['cinema_id' => $cinema->id]);
        $this->assertDatabaseHas('rooms', ['name' => $room->name]);
        $this->signInAs('Admin');
        $this->delete('/rooms/'.$room->id);

        $this->assertDatabaseMissing('rooms', ['name' => $room->name]);
    }

    public function testEmployeeCanDeleteRoom()
    {
        $cinema = factory(Cinema::class)->create();
        $room = factory(Room::class)->create(['cinema_id' => $cinema->id]);
        $this->assertDatabaseHas('rooms', ['name' => $room->name]);
        $this->signInAs('Admin');
        $this->delete('/rooms/'.$room->id);

        $this->assertDatabaseMissing('rooms', ['name' => $room->name]);
    }

    public function testUserDoNotHaveAccessToDeleteRoomRoute()
    {
        $cinema = factory(Cinema::class)->create();
        $room = factory(Room::class)->create(['cinema_id' => $cinema->id]);
        $this->signInAs('User');
        $this->delete('/rooms/'.$room->id)
            ->assertStatus(403);
    }
}
