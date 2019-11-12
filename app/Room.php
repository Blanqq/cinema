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

    public function cinema()
    {
        return $this->belongsTo(Cinema::class);
    }

    public function getOrderedSeats()
    {
        return $this->seats()->orderBy('row')->orderBy('seat')->get();
    }
}
