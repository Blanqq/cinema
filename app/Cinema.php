<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cinema extends Model
{
    protected $fillable = ['city', 'street', 'name', 'slug'];

    public static function boot()
    {
        parent::boot();
        static ::deleting(function ($cinema){
            $cinema->rooms->each->delete();
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function roomsFromCinema()
    {
        $rooms = DB::table('rooms')->where('cinema_id', $this->id)->orderBy('name')->get();
        return $rooms;
    }
}
