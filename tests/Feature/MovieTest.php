<?php

namespace Tests\Feature;

use App\Movie;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MovieTest extends TestCase
{
    use DatabaseMigrations;
    
    public function testAdminCanCreateNewMovie()
    {
        $movie = factory(Movie::class)->create();
        $this->signInAs('Admin');
    }
}
