<?php

namespace Tests\Feature;

use App\Cinema;
use App\Room;
use App\Seat;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SeatTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAdminCanAddNewSeat()
    {
        $cinema = factory(Cinema::class)->create();
        $room = factory(Room::class)->create(['cinema_id' => $cinema->id]);
        $seat = factory(Seat::class)->make(['room_id' => $room->id]);

        $this->assertDatabaseMissing('seats', ['row' => $seat->row, 'seat'=>$seat->seat]);

        $this->signInAs('Admin');
        $this->post('/seats/'.$room->id, $seat->toArray());

        $this->assertDatabaseHas('seats', ['row' => $seat->row, 'seat'=>$seat->seat]);
    }

    public function testEmployeCanAddNewSeat()
    {
        $cinema = factory(Cinema::class)->create();
        $room = factory(Room::class)->create(['cinema_id' => $cinema->id]);
        $seat = factory(Seat::class)->make(['room_id' => $room->id]);

        $this->assertDatabaseMissing('seats', ['row' => $seat->row, 'seat'=>$seat->seat]);

        $this->signInAs('Employee');
        $this->post('/seats/'.$room->id, $seat->toArray());

        $this->assertDatabaseHas('seats', ['row' => $seat->row, 'seat'=>$seat->seat]);
    }

    public function testUserDoNotHaveAccessToAddSeatRoute()
    {
        $cinema = factory(Cinema::class)->create();
        $room = factory(Room::class)->create(['cinema_id' => $cinema->id]);
        $seat = factory(Seat::class)->make(['room_id' => $room->id]);

        $this->assertDatabaseMissing('seats', ['row' => $seat->row, 'seat'=>$seat->seat]);

        $this->signInAs('User');
        $this->post('/seats/'.$room->id, $seat->toArray())
            ->assertForbidden();
    }

    public function testAdminCanDeleteSeat()
    {
        $seat = factory(Seat::class)->create();

        $this->assertDatabaseHas('seats', ['row' => $seat->row, 'seat'=>$seat->seat]);

        $this->signInAs('Admin');
        $this->delete('/seats/'.$seat->id);

        $this->assertDatabaseMissing('seats', ['row' => $seat->row, 'seat'=>$seat->seat]);
    }

    public function testEmployeeCanDeleteSeat()
    {
        $seat = factory(Seat::class)->create();

        $this->assertDatabaseHas('seats', ['row' => $seat->row, 'seat'=>$seat->seat]);

        $this->signInAs('Employee');
        $this->delete('/seats/'.$seat->id);

        $this->assertDatabaseMissing('seats', ['row' => $seat->row, 'seat'=>$seat->seat]);
    }

    public function testUserDoNotHaveAccessToDeleteSeatRoute()
    {
        $seat = factory(Seat::class)->create();
        $this->assertDatabaseHas('seats', ['row' => $seat->row, 'seat'=>$seat->seat]);
        $this->signInAs('User');
        $this->delete('/seats/'.$seat->id)
            ->assertForbidden();
    }

}
