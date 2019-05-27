<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Team;
use App\Notification;
use App\Tournament;

class TournamentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tournament=Tournament::whereDate('date','>', \Carbon\Carbon::today())->get();
        return view('pages.tournament')->with(['tournaments'=>$tournament]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function participate($id)
    {
      $user=Auth::user();
      $tournament=Tournament::find($id);
      $team= $user->teams()->wherePivot('status', '=', 'Leader')->first();
      if($team!=NULL)
      {
        if($exists=$team->tournaments()->where('tournament_id',$tournament->id)->count()>0)
        {
            return redirect('/tournament')->with('error','Already Participated in this Tournament');
          }
      else {
        $team->tournaments()->attach($tournament->id);

        return redirect('/tournament')->with('success',' Participated Successfully');
        }
      }
      else {
        return redirect('/tournament')->with('error','Your Dont Have This Authority');
      }
    }
}
