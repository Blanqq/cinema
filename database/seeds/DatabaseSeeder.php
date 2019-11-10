<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(MovieTableSeeder::class);
        $this->call(CinemasTableSeeder::class);
        $this->call(GenresTableSeeder::class);
        $this->call(SeatsTableSeeder::class);
        $this->call(ShowsTableSeeder::class);
    }
}
