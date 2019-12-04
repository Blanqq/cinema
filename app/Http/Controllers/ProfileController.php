<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        if (auth()->id() === $user->id || auth()->user()->isEmployee())
        {
            $reservations = $user->ticketsGroupedByReservations()->all();
            return view('profiles.show')->with(['user' => $user, 'reservations' => $reservations]);
        }
        return back();
    }
}
