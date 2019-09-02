<?php

namespace App\Http\Controllers;

use App\Room;
use App\Seat;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    public function store(Request $request, Room $room)
    {
        $data = $request->validate([
            'row' => ['required' , 'min:1' , 'max:255'],
            'seat' => ['required' , 'min:1' , 'max:255']
        ]);

        $seat = $room->seats()->where(function ($query) use ($data){
            $query->where('row', $data['row'])
                ->where('seat', $data['seat']);
        });
        if($seat->count()){
            $request->session()->flash('message', 'Seat with this row and seat number is all ready assigned to this room');
            $request->session()->flash('level', 'danger');
            return redirect()->action('RoomController@show', ['slug' => $room->cinema->slug ,'id' => $room->id]);
        }
        //dd($seat->count());

        $room->seats()->create($data);
        return redirect()->action('RoomController@show', ['slug' => $room->cinema->slug ,'id' => $room->id]);
    }

    public function destroy(Seat $seat)
    {
        $seat->delete();
        return redirect()->action('RoomController@show', ['slug' => $seat->room->cinema->slug ,
            'id' => $seat->room->id]);
    }
}
