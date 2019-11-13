<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['show_id', 'seat_id', 'reservation_id'];
}
