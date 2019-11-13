<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable =['name'];

    public function seats()
    {
        return $this->hasMany(Seat::class);
    }

    public static function seatsGroupedByRows($room_id)
    {
        $r = DB::table('seats')
            ->where('room_id', '=', $room_id)
            ->orderBy('row')
            ->orderBy('seat')
            ->get()
            ->groupBy('row');

        return $r;
    }

    public static function occupiedSeats(Show $show)
    {
        $r = DB::table('seats')
            ->join('tickets', 'tickets.seat_id', '=', 'seats.id')
            ->join('shows', 'shows.id', '=', 'tickets.show_id')
            ->where('tickets.show_id','=', $show->id)
            ->select('seats.id')
            ->get();
        return $r;
    }

    public function cinema()
    {
        return $this->belongsTo(Cinema::class);
    }

    public function getOrderedSeats()
    {
        return $this->seats()->orderBy('row')->orderBy('seat')->get();
    }
}
