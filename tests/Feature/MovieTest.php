<?php

namespace Tests\Feature;

use App\Movie;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MovieTest extends TestCase
{
    use DatabaseMigrations;

    public function testAdminCanCreateNewMovie()
    {
        $movie = factory(Movie::class)->make();
        $this->signInAs('Admin');
        $this->post('/movies/', $movie->toArray());
        $this->get('/movies/'. $movie->id)->assertSee($movie->name);
    }

    public function testEmployeeCanCreateNewMovie()
    {
        $movie = factory(Movie::class)->make();
        $this->signInAs('Employee');
        $this->post('/movies/', $movie->toArray());
        $this->get('/movies/'. $movie->id)->assertSee($movie->name);
    }

    public function testOtherUsersCanNotCreateNewMovie()
    {
        Storage::fake('public/posters');
        $movie = factory(Movie::class)->make(['poster' => UploadedFile::fake()->image('avatar.jpg')]);

        $this->signInAs('User');
        $this->post('/movies/', $movie->toArray())->assertForbidden();
    }

    public function testAdminCanEditMovie()
    {
        $this->signInAs('Admin');
        $movie = factory(Movie::class)->create(['name' => 'Some Title']);
        $this->get('/movies/'.$movie->id)->assertSee($movie->title);
        $editedMovie = factory(Movie::class)->make();
        $this->put('/movies/'.$movie->id, $editedMovie->toArray());
        $this->get('/movies/'.$movie->id)->assertSee($editedMovie->name);
    }

    public function testEmployeeCanEditMovie()
    {
        $this->signInAs('Employee');
        $movie = factory(Movie::class)->create(['name' => 'Some Title']);
        $this->get('/movies/'.$movie->id)->assertSee($movie->title);
        $editedMovie = factory(Movie::class)->make();
        $this->put('/movies/'.$movie->id, $editedMovie->toArray());
        $this->get('/movies/'.$movie->id)->assertSee($editedMovie->name);
    }

    public function testUserDoNotHaveAccessToEditMovieRoute()
    {
        $this->signInAs('User');
        $movie = factory(Movie::class)->create();
        $this->put('/movies/'.$movie->id, $movie->toArray())->assertForbidden();
    }

    // DELETE MOVIE FEATURE CURRENTLY DISABLED

    // public function testAdminCanDeleteMovie()
    // {
    //     $this->signInAs('Admin');
    //     $movie = factory(Movie::class)->create();
    //     $this->assertDatabaseHas('movies', ['name' => $movie->name]);

    //     $this->delete('/movies/'.$movie->id);
    //     $this->assertDatabaseMissing('movies', ['name' => $movie->name]);
    // }

    // public function testEmployeeCanDeleteMovie()
    // {
    //     $this->signInAs('Employee');
    //     $movie = factory(Movie::class)->create();
    //     $this->assertDatabaseHas('movies', ['name' => $movie->name]);

    //     $this->delete('/movies/'.$movie->id);
    //     $this->assertDatabaseMissing('movies', ['name' => $movie->name]);
    // }

    // public function testUserDoNotHaveAccessToDeleteMovieRoute()
    // {
    //     $this->signInAs('User');
    //     $movie = factory(Movie::class)->create();

    //     $this->delete('/movies/'.$movie->id)->assertForbidden();
    // }
}
