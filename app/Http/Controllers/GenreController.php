<?php

namespace App\Http\Controllers;

use App\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::all();
        return view('genres.index')->with('genres', $genres);
    }

    public function create()
    {
        return view('genres.create');
    }

    public function store(Request $request)
    {
        $request->validate( [
            'name' => ['required']
        ]);

        Genre::create(['name' => request('name')]);
        $request->session()->flash('message', 'Genre successfully added!');
        $request->session()->flash('level', 'success');

        return redirect()->route('genre.index');
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();
        return redirect()->route('genre.index');
    }

    public function edit(Genre $genre)
    {
        return view('genres.edit')->with('genre', $genre);
    }

    public function update(Request $request, Genre $genre)
    {
        $r = $request->validate([
            'name' => ['required']
        ]);
        $genre->update($r);
        return redirect('/genres');
    }
}
