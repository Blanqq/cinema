<?php

namespace App\Http\Controllers;

use App\Cinema;
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
}
