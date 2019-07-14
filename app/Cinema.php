<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cinema extends Model
{
    protected $fillable = ['city', 'street', 'name', 'slug'];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
