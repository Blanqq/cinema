<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = ['name', 'year', 'poster', 'description'];

    public function getPosterPathAttribute()
    {
        if($this->poster){
            return '/storage/'.$this->poster;
        }
        return '/images/default_poster.jpg';
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }
}
