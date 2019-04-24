<?php

namespace Tests\Feature;

use App\Cinema;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CinemaPageTest extends TestCase
{
    use DatabaseMigrations;
    public function testAnyUserCanSeePageOfTheCinema()
    {
        $cinema = factory(Cinema::class)->create();
        $response = $this->get('/'.$cinema->id);
        $response->assertSee($cinema->name);
    }
}
