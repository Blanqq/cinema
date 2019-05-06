<?php

namespace Tests\Feature;

use App\Cinema;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CinemaPageTest extends TestCase
{
    use DatabaseMigrations;
    public function testAnyUserCanSeePageOfTheCinema()
    {
        $cinema = factory(Cinema::class)->create();
        $response = $this->get('/'.$cinema->slug);
        $response->assertSee($cinema->name);
    }
}
