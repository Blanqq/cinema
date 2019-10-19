<?php

namespace App\Http\Controllers;

use App\Cinema;
use App\Show;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function index(Request $request, Cinema $cinema)
    {
        if(request('date') == null){
            $date = Carbon::today();
            $shows_grouped_by_rooms = Show::showsFromCinemaAndDate($cinema, $date);
        }
        if(request('date')){
            $shows_grouped_by_rooms = Show::showsFromCinemaAndDate($cinema, Carbon::parse(request('date')));
        }

        return view('shows.index')->with(['shows_grouped_by_rooms' => $shows_grouped_by_rooms,
            'cinema' => $cinema]);
    }
}
