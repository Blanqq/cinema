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
}
