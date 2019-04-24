<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cinema extends Model
{
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
