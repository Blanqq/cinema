<?php

namespace App\Http\Controllers;

use App\Cinema;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CinemaController extends Controller
{
    public function index()
    {
        return view('cinemas.index')->with(['cinemas' => Cinema::all()]);
    }

    public function show(Cinema $cinema)
    {
        return view('cinemas.show')
            ->with(['cinema' => Cinema::findOrFail($cinema->id),
                'rooms' => Cinema::findOrFail($cinema->id)->rooms
            ]);
    }

    public function create()
    {
        return view('cinemas.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'city' => ['required'],
            'street' => ['required'],
        ]);

        $data['name'] = request('city').' '.request('street');
        $data['slug'] = Str::slug($data['name']);

        Cinema::create($data);

        return redirect('/cinemas/');
    }

    public function edit(Cinema $cinema)
    {
        return view('cinemas.edit')->with(['cinema' => Cinema::findOrFail($cinema->id)]);
    }

    public function update(Request $request, Cinema $cinema)
    {
        $data = $request->validate([
            'city' => ['required'],
            'street' => ['required'],
        ]);

        $data['name'] = request('city').' '.request('street');
        $data['slug'] = Str::slug($data['name']);

        $cinema->update($data);

        return redirect()->action('CinemaController@edit', ['slug' => $cinema->slug])
            ->with(['cinema' => $cinema]);
    }

    public function destroy(Cinema $cinema)
    {
        $cinema->delete();
        return redirect('/cinemas/');
    }
}
