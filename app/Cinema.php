<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
