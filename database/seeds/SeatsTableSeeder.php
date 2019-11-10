<?php

use App\Seat;
use App\Room;
use Illuminate\Database\Seeder;

class SeatsTableSeeder extends Seeder
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
            foreach (range(1,10) as $row_index){
                foreach (range(1,15) as $seat_index){
                    factory(Seat::class)->create([
                        'room_id' => $room->id,
                        'row' => $row_index,
                        'seat' => $seat_index
                    ]);
                }
            }
        }
    }
}
