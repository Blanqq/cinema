<?php

namespace App\Http\Controllers;

use App\Cinema;
use App\Show;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class CinemaPageController extends Controller
{
    public function show(Cinema $cinema)
    {
        $date = Carbon::now();
        $days_to_select = CarbonPeriod::create(Carbon::now(), Carbon::now()->addDays(7));
        if(request('date') == null){
            $date = Carbon::today();
            $shows_grouped_by_movie = Show::showsFromCinemaGroupedByMovie($cinema, $date);
        }
        if(request('date')){
            $date = Carbon::parse(request('date'));
            $shows_grouped_by_movie = Show::showsFromCinemaGroupedByMovie($cinema, $date);
        }
        //dd($shows_grouped_by_movie);
        return view('cinema-page.show')->with(['cinema' => $cinema,
            'date' => $date,
            'shows_grouped_by_movie' => $shows_grouped_by_movie,
            'days_to_select' => $days_to_select
        ]);
    }
}
