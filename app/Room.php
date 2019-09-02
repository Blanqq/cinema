<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable =['name'];

    public function seats()
    {
        return $this->hasMany(Seat::class);
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
