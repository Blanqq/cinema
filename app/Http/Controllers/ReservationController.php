<?php

namespace App\Http\Controllers;

use App\Cinema;
use App\Reservation;
use App\Show;
use App\Ticket;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function store(Request $request, Cinema $cinema, Show $show)
    {
        $request->validate([
            'seats' => ['required']
        ]);

        $reservation = Reservation::create(['user_id' => auth()->id(),]);

        foreach ($request->seats as $seat_id)
        {
            Ticket::create([
                'seat_id' => $seat_id,
                'show_id' => $show->id,
                'reservation_id' => $reservation->id
            ]);
        }
        return back();
    }
}
