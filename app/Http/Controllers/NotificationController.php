<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Notification;
use App\Team;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $user = Auth::user();
          $notification = User::find($user->id)->notifications;
          return view('pages.notifications')->with(['notifications'=>$notification]);
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
    public function requestUT($id)
    {
      $team = Team::find($id);
      $leader= $team->users()->wherePivot('status', '=', 'Leader')->first();
      $user = Auth::user();
      if($exists=$user->teams()->where('team_id',$team->id)->count()>0)
      {
          return redirect('/teams')->with('error','you are already in this team');
      }
      else{
      $notification=new Notification;
      $notification->type="requestUT";
      $notification->sender_id=$user->id;
      $notification->user_id=$leader->id;
      $notification->save();
      return redirect('/teams')->with('success','Request Sended');
    }
    }
    public function requestTU($id)
    {
      $player=User::find($id);
      $user=Auth::user();
      $team= $user->teams()->wherePivot('status', '=', 'Leader')->first();
      if($team!=NULL)
      {
        if($exists=$player->teams()->where('team_id',$team->id)->count()>0)
        {
            return redirect('/players')->with('error','This player is already in your team');
        }
        else
        {
        $notification=new Notification;
        $notification->type="requestTU";
        $notification->sender_id=$team->id;
        $notification->user_id=$player->id;
        $notification->save();
        return redirect('/players')->with('success','Request Sended');
        }
      }
      else {
        return redirect('/players')->with('error','Your Dont Have This Authority');
      }
    }

    public function ADDTOTEAM($id){
        $player=User::find($id);
        $user=Auth::user();
        $team= $user->teams()->wherePivot('status', '=', 'Leader')->first();
        if($team!=NULL)
        {
        $player->teams()->attach($team,['status'=>"Member"]);
        $notification=new Notification;
        $notification->type="acceptTU";
        $notification->sender_id=$team->id;
        $notification->user_id=$player->id;
        $notification->save();
        $user->notifications()->where('sender_id',$player->id)->where('type','requestUT')->delete();
        return redirect('/notifications')->with('success','Player Has Added');
        }
        else {
            $user->notifications()->where('sender_id',$player->id)->where('type','requestUT')->delete();
            return redirect('/notifications')->with('error','Your Dont Have This Authority Anymore');
        }
    }
    public function DECLINE($id){
      $player=User::find($id);
      $user=Auth::user();
      $team= $user->teams()->wherePivot('status', '=', 'Leader')->first();
      if($team!=NULL)
      {
        $notification=new Notification;
        $notification->type="declineTU";
        $notification->sender_id=$team->id;
        $notification->user_id=$player->id;
        $notification->save();
        $user->notifications()->where('sender_id',$player->id)->where('type','requestUT')->delete();
        return redirect('/notifications');
      }
      else{
            $user->notifications()->where('sender_id',$player->id)->where('type','requestUT')->delete();
            return redirect('/notifications')->with('error','Your Dont Have This Authority Anymore');
        }
    }
    public function HIDE($id){
        $user=Auth::user();
    $user->notifications()->where('id',$id)->delete();
      return redirect('/notifications');
    }
    public function JOINTEAM($id){
      $team=Team::find($id);
      $user=Auth::user();
      if($team!=NULL)
      {
      $team->users()->attach($user,['status'=>"Member"]);
      $user->notifications()->where('sender_id',$team->id)->where('type','requestTU')->delete();
      return redirect('/notifications')->with('success','You Joined Team');
    }else {
      $user->notifications()->where('sender_id',$team->id)->where('type','requestTU')->delete();
      return redirect('/notifications')->with('error','Team Invalid');
    }
    }

}
