<?php

namespace Tests\Feature;

use App\Cinema;
use App\Room;
use App\Seat;
use App\Show;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReservationTicketTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUnsignedUserCantMakeReservation()
    {
        //$this->withExceptionHandling();
        $cinema = factory(Cinema::class)->create();
        $room = factory(Room::class)->create(['cinema_id' => $cinema->id]);
        $seats = factory(Seat::class, 2)->create(['room_id' => $room->id]);
        $seatsIds = [];
        foreach($seats as $seat){
            array_push($seatsIds, $seat->id);
        }
        $show = factory(Show::class)->create(['room_id' => $room->id]);

        $this->post('/cinemas/'.$cinema->slug.'/shows/'.$show->id.'/reservations', $seatsIds)
            ->assertRedirect('login');
    }
}
