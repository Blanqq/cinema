<?php

namespace App\Http\Controllers;

use App\Room;
use App\Cinema;
use App\Seat;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function store(Request $request, Cinema $cinema)
    {
        $data = $request->validate([
            'name' => ['required']
        ]);

        $cinema->rooms()->create($data);

        return redirect()->action('CinemaController@show', ['slug' => $cinema->slug]);
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return back();
    }

    public function show(Cinema $cinema, Room $room)
    {
        //$seats = Room::orderBy('row')->orderBy('seat')->findOrFail($room->id)->seats;
        $seats = $room->getOrderedSeats();

        return view('rooms.show')->with(['cinema' => $cinema, 'room' => $room, 'seats' => $seats]);
    }
}
