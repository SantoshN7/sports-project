<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Sport;
use App\Team;
use App\Notification;
use Image;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $sport = Sport::all();
        $team = User::find($user->id)->teams;
        return view('teamdash')->with(['teams'=>$team,'sports'=>$sport]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      $this->validate($request,[
        'name' =>'required',
        'type'=>'required'
      ]);
      $team = new Team;
      $team->name =$request->input('name');
      $team->type=$request->input('type');
      if($request->hasFile('avatar')!=NULL)
      {
      $avatar=$request->file('avatar');
      $filename=time().'.'.$avatar->getClientOriginalExtension();
      Image::make($avatar)->resize(300,300)->save(public_path('media/teamavatars/'.$filename));
      $team->logo=$filename;
      }
      $team->save();
        $user = Auth::user();
        $user->teams()->attach($team,['status'=>"Leader"]);
        return redirect('dashboard')->with('success','Team created');
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
        $team = Team::find($id);
        $players =Team::find($id)->users;
        return view('pages.showteam')->with(['team'=>$team,'players'=>$players]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $team = Team::find($id);
      $sport = Sport::all();
      $players =Team::find($id)->users;
      $team_sport = Team::find($team->id)->sports2;
      return view('pages.editteam')->with(['team'=>$team,'sports'=>$sport,'players'=>$players,'team_sports'=>$team_sport]);
    }
    public function delete($id)
    {
      $team = Team::find($id);
      $team->delete();
      return redirect('/team')->with('success','Team Deleted');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $this->validate($request,[
        'name' =>'required',
        'type'=>'required'
      ]);
      $id=$request->input('id');
      $team = Team::find($id);
      $team->name =$request->input('name');
      $team->type=$request->input('type');
      if($request->hasFile('avatar')!=NULL)
      {
      $avatar=$request->file('avatar');
      $filename=time().'.'.$avatar->getClientOriginalExtension();
      Image::make($avatar)->resize(300,300)->save(public_path('media/teamavatars/'.$filename));
      $team->logo=$filename;
      }
      $team->save();
        return redirect('/team')->with('success','Team Updated');
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
    public function LEAVETEAM($id)
    {
      $team = Team::find($id);
      $leader= $team->users()->wherePivot('status', '=', 'Leader')->first();
      $user = Auth::user();
      if($leader->id==$user->id)
      {
          return redirect('/team')->with('error','Pass leadership to someone other before leaving');
      }
      else{
      $user->teams()->detach($id);
      return redirect('dashboard')->with('success',' Leaved Successfully');
    }
  }
  public function addsport2(Request $request)
  {
    $this->validate($request,[
      'sport' =>'required',
    ]);
    $id=$request->input('id');
    $team = Team::find($id);
      $sid =$request->input('sport');
      $team->sports2()->attach($sid);
    return redirect('/team')->with('success','Sport Added');
  }
  public function deletesport2($id,$teamid){
      $team=Team::find($teamid);
        $team->sports2()->detach($id);
        return redirect('/team')->with('success','Sport Removed');
  }
  public function kick($id,$teamid){
        $team=Team::find($teamid);
        $user=User::find($id);
        $team->users()->detach($user->id);
        $notification=new Notification;
        $notification->type="kick";
        $notification->sender_id=$team->id;
        $notification->user_id=$user->id;
        $notification->save();
        return redirect('/team')->with('success','Player Removed');
  }
    public function leader($id,$teamid){
      $user=Auth::user();
      $player=User :: find($id);
      $team=Team :: find($teamid);
       $team->users()->updateExistingPivot($player->id, ['status' => 'Leader']);
        $team->users()->updateExistingPivot($user->id, ['status' => 'Member']);
      $notification=new Notification;
      $notification->type="leader";
      $notification->sender_id=$team->id;
      $notification->user_id=$player->id;
      $notification->save();
      return redirect('/team')->with('success','Successfull...');
    }
}
