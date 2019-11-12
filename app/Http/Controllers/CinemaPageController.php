<?php

namespace App\Http\Controllers;

use App\Cinema;
use App\Show;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CinemaPageController extends Controller
{
    public function show(Cinema $cinema)
    {
        $date = Carbon::now();
        if(request('date') == null){
            $date = Carbon::today();
            $shows_grouped_by_movie = Show::showsFromCinemaGroupedByMovie($cinema, $date);
        }
        if(request('date')){
            $date = Carbon::parse(request('date'));
            $shows_grouped_by_movie = Show::showsFromCinemaGroupedByMovie($cinema, $date);
        }
        return view('cinema-page.show')->with(['cinema' => $cinema,
            'date' => $date,
            'shows_grouped_by_movie' => $shows_grouped_by_movie
        ]);
    }
}
