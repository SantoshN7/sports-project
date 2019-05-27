<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Sport;
use App\Team;

class PagesController extends Controller
{
  public function index(){
    return view('pages.index');
  }
  public function createteam(){
      $user = Auth::user();
    if($exists=$user->teams()->wherePivot('status', '=', 'Leader')->count()>0)
    {
        return redirect('/team')->with('error','you are already a leader of one team');
    }
    else{
    return view('pages.createteam');
    }
  }
}
