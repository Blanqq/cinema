<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function isAdmin()
    {
        if($this === null)
        {
            return false;
        }
        if(count($this->roles()->where('name', 'Admin')->get()))
        {
            return true;
        }
        return false;
    }

    public function isEmployee()
    {
        if($this === null)
        {
            return false;
        }

        if(count($this->roles()->where(function($q) {$q->where('name', 'Employee')->orWhere('name', 'Admin');})->get()))
        {
            return true;
        }
        return false;
    }

    public function ticketsGroupedByReservations()
    {
        $reservations = DB::table('tickets')
            ->join('reservations', 'reservations.id', '=', 'tickets.reservation_id')
            ->join('seats', 'seats.id', '=', 'tickets.seat_id')
            ->join('shows', 'shows.id', '=','tickets.show_id')
            ->where('reservations.user_id', '=', $this->id)
            ->orderBy('shows.starts_at', 'DESC')
            ->select([
                'tickets.*',
                DB::raw('(SELECT name FROM users WHERE id='.$this->id.')AS user_name'),
                'reservations.paid AS reservation_paid',
                'reservations.id AS reservation_id',
                'seats.row AS row',
                'seats.seat AS seat',
                'shows.starts_at AS show_start',
                DB::raw('(SELECT name FROM rooms WHERE id=seats.room_id)AS room_name'),
                DB::raw('(SELECT name FROM movies WHERE id=shows.movie_id)AS movie_name'),
                DB::raw('(SELECT cinema_id FROM rooms WHERE id=seats.room_id)AS cinema_id'),
                DB::raw('(SELECT name FROM cinemas WHERE id=cinema_id)AS cinema_name')
                ])
            ->get()
            ->groupBy('reservation_id');
        return $reservations;
        //return $this->hasMany(Reservation::class);
    }

    public function roles()
    {
        return $this->BelongsToMany(Role::class);
    }

    public  function hasRole($role)
    {
        if($this->roles()->where('name',$role)->first())
        {
            return true;
        }
        return false;
    }
}
