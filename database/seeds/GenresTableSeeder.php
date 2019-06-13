<?php

use Illuminate\Database\Seeder;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Genre::class)->create(['name' => 'Thriller']);
        factory(App\Genre::class)->create(['name' => 'Science Fiction']);
        factory(App\Genre::class)->create(['name' => 'Comedy']);
        factory(App\Genre::class)->create(['name' => 'Drama']);
        factory(App\Genre::class)->create(['name' => 'Horror']);
        factory(App\Genre::class)->create(['name' => 'Mystery']);
        factory(App\Genre::class)->create(['name' => 'Western']);
    }
}
