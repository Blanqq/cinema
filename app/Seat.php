<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    protected $fillable = ['row', 'seat'];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
