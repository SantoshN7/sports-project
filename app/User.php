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
    public function sports(){
      return $this->belongsToMany('App\Sport','sports_users')->withPivot("role");
    }
    public function teams(){
      return $this->belongsToMany('App\Team','teams_users')->withPivot("status");
    }
    public function notifications(){
       return $this->hasMany('App\Notification');
   }
}
