<?php

namespace App\Http\Controllers\Api;

use App\Movie;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MoviePosterController extends Controller
{
    public function store(Request $request, Movie $movie)
    {
        $request->validate([
            'poster' => ['required']
        ]);

        $movie->update([
            'poster' => request()->file('poster')->store('images/posters', 'public')
        ]);
        //return back(200);
        return redirect()->action('MovieController@show', ['id' => $movie->id]);
    }

    public function destroy(Movie $movie)
    {
        Storage::delete('/public/'. $movie->poster);

        $movie->update([
            'poster' => ''
        ]);



        return back();
    }
}
