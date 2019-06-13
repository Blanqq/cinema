<?php

namespace App\Http\Controllers;

use App\Movie;
use App\Genre;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('movies.index')->with(['movies' => Movie::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genres = Genre::all()->sortBy('name');
        return view('movies.create')->with(['genres' => $genres]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate( [
            'name' => ['required'],
            'year' => ['required'],
            'description' => ['required']
        ]);

        $movie = Movie::create(['name' => request('name'),
                'year' => request('year'),
                'description' => request('description'),
                'poster' => request()->file('poster')->store('images/posters', 'public')
            ]);

        $movie->genres()->attach(request('genres'));
        $movie_genres = $movie->genres;
        //return view('movies.show', $movie->id)->with(['movie' => $movie, 'movie_genres' => $movie_genres]);
        return redirect()->action('MovieController@show', ['id' => $movie->id])
            ->with(['movie' => $movie, 'movie_genres' => $movie_genres]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = Movie::find($id);
        $movie_genres = $movie->genres;
        return view('movies.show')->with(['movie' => $movie, 'movie_genres' => $movie_genres]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
