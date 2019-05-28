<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\Genre;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GenreTest extends TestCase
{
    use DatabaseMigrations;

    public function testAdminCanSeeGenresPage()
    {
        $genre = factory(Genre::class)->create();
        $this->signInAs('Admin');
        $this->get('/genres/')->assertSee($genre->name)->assertStatus(200);
    }
    public function testEmployeeCanSeeGenresPage()
    {
        $genre = factory(Genre::class)->create();
        $this->signInAs('Employee');
        $this->get('/genres/')->assertSee($genre->name)->assertStatus(200);
    }
    public function testUsersCanNotSeeGenresPage()
    {
        $genre = factory(Genre::class)->create();
        $this->signInAs('User');
        $this->get('/genres/')->assertDontSee($genre->name)->assertStatus(403);
    }

    public function testAdminCanAddNewGenre()
    {
        $genre = factory(Genre::class)->make();
        $this->signInAs('Admin');
        $this->post('/genres/', $genre->toArray());
        $this->get('/genres/')->assertSee($genre->name)->assertStatus(200);
    }
    public function testEmployeeCanAddNewGenre()
    {
        $genre = factory(Genre::class)->make();
        $this->signInAs('Employee');
        $this->post('/genres/', $genre->toArray());
        $this->get('/genres/')->assertSee($genre->name)->assertStatus(200);
    }
    public function testUserCanNotAddNewGenre()
    {
        $genre = factory(Genre::class)->make();
        $this->signInAs('User');
        $this->post('/genres/', $genre->toArray())->assertStatus(403);
    }
    public function testAdminCanDeleteGenre()
    {
        $genre = factory(Genre::class)->create();
        $this->signInAs('Admin');
        $this->delete('/genres/'.$genre->id);
        $this->get('/genres/')->assertDontSee($genre->name)->assertStatus(200);
        $this->assertDatabaseMissing('genres', ['id' => $genre->id]);
    }
    public function testEmployeeCanDeleteGenre()
    {
        $genre = factory(Genre::class)->create();
        $this->signInAs('Employee');
        $this->delete('/genres/'.$genre->id);
        $this->get('/genres/')->assertStatus(200);
        $this->assertDatabaseMissing('genres', ['id' => $genre->id]);
    }
    public function testUserCanNotDeleteGenre()
    {
        $genre = factory(Genre::class)->create();
        $this->signInAs('User');
        $this->delete('/genres/'.$genre->id);
        $this->assertDatabaseHas('genres', ['id' => $genre->id]);
    }
}
