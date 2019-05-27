<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
  public function sports2(){
    return $this->belongsToMany('App\Sport','sports_teams');
  }
  public function users(){
    return $this->belongsToMany('App\User','teams_users')->withPivot("status");
  }
  public function tournaments(){
    return $this->belongsToMany('App\Tournament','tournaments_teams');
  }
}
