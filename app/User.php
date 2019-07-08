<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
