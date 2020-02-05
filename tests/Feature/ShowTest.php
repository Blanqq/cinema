<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Movie;
use App\Room;
use App\Cinema;
use App\Show;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ShowTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAdminCanCreateNewShow()
    {
        $cinema = factory(Cinema::class)->create();
        $movie = factory(Movie::class)->create();
        $room = factory(Room::class)->create(['cinema_id' => $cinema->id]);

        $show = factory(Show::class)->make(['movie_id' => $movie->id, 'room_id' => $room->id]);
        $date = Carbon::now()->format('Y-m-d');
        $time = Carbon::now()->isoFormat('HH:mm');
        $this->assertDatabaseMissing('shows', ['movie_id' => $show->movie_id]);

        $this->signInAs('Admin');

        $this->post('/cinemas/'.$cinema->slug.'/shows', [
            'movie' => $movie->id,
            'room' => $room->id,
            'starts_at_date' => $date,
            'starts_at_time' => $time,
            'ends_at_date' => $date,
            'ends_at_time' => Carbon::now()->addHours(2)->isoFormat('HH:mm')
        ]);

        $this->assertDatabaseHas('shows', ['movie_id' => $show->movie_id]);

    }
    public function testEmployeeCanCreateNewShow()
    {
        $cinema = factory(Cinema::class)->create();
        $movie = factory(Movie::class)->create();
        $room = factory(Room::class)->create(['cinema_id' => $cinema->id]);

        $show = factory(Show::class)->make(['movie_id' => $movie->id, 'room_id' => $room->id]);
        $date = Carbon::now()->format('Y-m-d');
        $time = Carbon::now()->isoFormat('HH:mm');
        $this->assertDatabaseMissing('shows', ['movie_id' => $show->movie_id]);

        $this->signInAs('Employee');

        $this->post('/cinemas/'.$cinema->slug.'/shows', [
            'movie' => $movie->id,
            'room' => $room->id,
            'starts_at_date' => $date,
            'starts_at_time' => $time,
            'ends_at_date' => $date,
            'ends_at_time' => Carbon::now()->addHours(2)->isoFormat('HH:mm')
        ]);

        $this->assertDatabaseHas('shows', ['movie_id' => $show->movie_id]);
    }

    public function testUserDoNotHaveAccessToAddShowRoute()
    {
        $cinema = factory(Cinema::class)->create();
        $movie = factory(Movie::class)->create();
        $room = factory(Room::class)->create(['cinema_id' => $cinema->id]);

        $show = factory(Show::class)->make(['movie_id' => $movie->id, 'room_id' => $room->id]);
        $date = Carbon::now()->format('Y-m-d');
        $time = Carbon::now()->isoFormat('HH:mm');
        $this->signInAs('User');

        $this->post('/cinemas/'.$cinema->slug.'/shows', [
            'movie' => $movie->id,
            'room' => $room->id,
            'starts_at_date' => $date,
            'starts_at_time' => $time,
            'ends_at_date' => $date,
            'ends_at_time' => Carbon::now()->addHours(2)->isoFormat('HH:mm')
        ])->assertForbidden();
    }
}
