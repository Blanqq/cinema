<?php

namespace App\Http\Controllers;

use App\Cinema;
use App\Http\Requests\StoreShowRequest;
use App\Movie;
use App\Show;
use App\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function index(Request $request, Cinema $cinema)
    {
        $date = Carbon::now();
        if(request('date') == null){
            $date = Carbon::today();
            $shows_grouped_by_rooms = Show::showsFromCinemaAndDate($cinema, $date);
        }
        if(request('date')){
            $date = Carbon::parse(request('date'));
            $shows_grouped_by_rooms = Show::showsFromCinemaAndDate($cinema, $date);
        }
        return view('shows.index')->with(['shows_grouped_by_rooms' => $shows_grouped_by_rooms,
            'cinema' => $cinema,
            'date' => $date,
            'movies' => Movie::all(),
            'rooms' => $cinema->rooms
            ]);
    }

    public function show(Cinema $cinema, Show $show)
    {
        //$room = Room::where('id', $show->room_id)->first();

        $seatsGroupedByRows = Room::seatsGroupedByRows($show->room_id);
        $occupied_seats = Room::occupiedSeats($show);
        $movie = $show->movie->find($show->movie_id);

        return view('shows.show')->with([
            'show' => $show,
            'seats_grouped_by_rows' => $seatsGroupedByRows,
            'movie' => $movie,
            'cinema' => $cinema,
            'occupied_seats' => $occupied_seats
        ]);
    }

    public function store(StoreShowRequest $request)
    {
        $starts_at_datetime = Carbon::createFromFormat('Y-m-d H:i', $request->starts_at_date.' '.$request->starts_at_time);
        $ends_at_datetime = Carbon::createFromFormat('Y-m-d H:i', $request->ends_at_date.' '.$request->ends_at_time);

        if(Show::isRoomOccupied($starts_at_datetime, $ends_at_datetime, $request->room))
        {
            $request->session()->flash('message', 'Room is occupied select different room or change time');
            $request->session()->flash('level', 'danger');
            return back();
        }
        Show::create([
            'movie_id' => $request->movie,
            'room_id' => $request->room,
            'starts_at' => $starts_at_datetime,
            'ends_at' => $ends_at_datetime
        ]);

        $request->session()->flash('message', 'Show added');
        $request->session()->flash('level', 'success');
        return back();
    }
}
