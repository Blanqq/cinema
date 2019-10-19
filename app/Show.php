<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Show extends Model
{
    protected $guarded = [];

    public static function showsFromCinemaAndDate(Cinema $cinema, Carbon $date_from)
    {
        $date_to = clone $date_from;
        $date_to->addDay();

        $shows = DB::table('shows')
            ->join('rooms', 'shows.room_id', '=', 'rooms.id')
            ->where('rooms.cinema_id', '=', $cinema->id)
            ->whereBetween('shows.starts_at', [$date_from, $date_to])
            ->orderBy('rooms.id')
            ->orderBy('shows.starts_at')
            ->select(['shows.*', 'rooms.name AS room_name'])
            ->get()
            ->groupBy('room_name');

        return $shows;
    }
}
