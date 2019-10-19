<?php

use App\Cinema;
use App\Room;
use App\Show;
use Illuminate\Database\Seeder;

class CinemasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N'];
        foreach (range(1,5) as $i1){
            factory(Cinema::class)->create(['id' => $i1]);
            foreach (range(1, 10) as $i2){
                factory(Room::class)
                    ->create(['id' => $i2+(10*($i1-1)), 'name' => $names[$i2-1], 'cinema_id' => $i1]);
                foreach (range(0,100, 20) as $hour){
                    factory(Show::class)->create([
                        ]);
                }
            }
        }
    }
}
