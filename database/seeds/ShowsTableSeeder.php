<?php

use App\Room;
use App\Show;
use App\Movie;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ShowsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rooms = Room::all();
        foreach ($rooms as $room){
            $start_date = Carbon::now();
            $end_date = Carbon::now()->addMinutes(120);
            foreach (range(1,3000, 120) as $min){
                factory(Show::class)->create([
                    'starts_at' => $start_date->addMinutes($min),
                    'ends_at' => $end_date->addMinutes($min),
                    'movie_id' => Movie::all()->random()->id,
                    'room_id' => $room->id
                ]);
            }
        }
    }
}
