<?php

use App\User;
use App\Cinema;
use App\Role;
use App\Genre;
use App\Movie;
use App\Room;
use App\Show;
use App\Seat;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => null,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(Role::class, function (Faker $faker){
    return[
        'name' => $faker->word
    ];
});

$factory->define(Cinema::class, function (Faker $faker){
    $city = $faker->city;
    $city_slug = Str::slug($city);
    $street = $faker->streetName;
    $street_slug = Str::slug($street);
    return [
        'name' => $city.' '.$street,
        'city' => $city,
        'street' => $street,
        'slug' => $city_slug.'-'.$street_slug,
    ];
});

$factory->define(Genre::class, function (Faker $faker){
    return[
        'name' => $faker->jobTitle
    ];
});

$factory->define(Movie::class, function (Faker $faker){
    $name = $faker->company;
    return[
        'name' => $name,
        'year' => $faker->numberBetween(2000, 2019),
        'poster' => '',
        'movie_premiere_image' => '',
        'description' => $faker->paragraphs(2, true),
    ];
});

$factory->define(Room::class,function (Faker $faker){
   return[
       'name' => $faker->colorName,
       'cinema_id' => Cinema::all()->count() ? Cinema::all()->random()->id : factory(Cinema::class)->create()->id,
   ];
});

$factory->define(Show::class, function (Faker $faker){
    $date = $faker->dateTimeBetween('now', '+ 10 days');
   return[
       'starts_at' => $date,
       'ends_at' => $date,
        'movie_id' => Movie::all()->count() ? Movie::all()->random()->id : factory(Movie::class)->create()->id,
        'room_id' => Room::all()->count() ? Room::all()->random()->id : factory(Room::class)->create()->id,
   ];
});

$factory->define(Seat::class, function(Faker $faker){
    return[
        'room_id' => Room::all()->count() ? Room::all()->random()->id : factory(Room::class)->create()->id,
        'row' => $faker->numberBetween(1,20),
        'seat' => $faker->numberBetween(1,30)
    ];
});

/*$factory->define(Movie::class, function (Faker $faker){
    $name = $faker->company;
    return[
        'name' => $name,
        'year' => $faker->numberBetween(2000, 2019),

        'poster' => $faker     // image faker uses lorempixel.com service if service is down faker returns 0
            ->image('public/storage/images/posters',420, 594, 'people', false),
        'movie_premiere_image' =>
            $faker->image('public/storage/images/premiere_images', 1280, 720,null, false),
        'description' => $faker->paragraphs(2, true),
    ];
});*/

/*$factory->state(Movie::class, 'test', function (Faker $faker){
    $name = $faker->company;
    return[
        'name' => $name,
        'year' => $faker->numberBetween(2000, 2019),
        'poster' => null,
        'movie_premiere_image' => null,
        'description' => $faker->paragraphs(2, true),
    ];
});*/
