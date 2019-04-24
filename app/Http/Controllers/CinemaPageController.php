<?php

namespace App\Http\Controllers;

use App\Cinema;
use Illuminate\Http\Request;

class CinemaPageController extends Controller
{
    public function show(Cinema $cinema)
    {
        return view('cinema-page.show')->with('cinema', $cinema);
    }
}
