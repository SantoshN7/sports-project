<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Sport;
use Image;

class DashboardController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      $sport = Sport::all();
      $user = Auth::user();
      $user_sport = User::find($user->id)->sports;
      return view('dashboard')->with(['user_sports'=>$user_sport,'sports'=>$sport]);
    }

    protected function update(Request $request)
    {
        $this->validate($request,[
          'name' =>'required',
          'email'=>'required'
        ]);
        //update User
      $user = Auth::user();
      $user->name =$request->input('name');
      $user->email =$request->input('email');
      $user->phoneno =$request->input('phoneno');
      $user->birthdate=$request->input('BirthDate');
      $user->gender =$request->input('gender');
      if($request->hasFile('avatar')!=NULL)
      {
      $avatar=$request->file('avatar');
      $filename=time().'.'.$avatar->getClientOriginalExtension();
      Image::make($avatar)->resize(300,300)->save(public_path('media/avatars/'.$filename));
      $user->avatar=$filename;
      }
      $user->save();


      return redirect('dashboard')->with('success','Profile Updated');
    }

    public function addsport(Request $request)
    {
      $this->validate($request,[
        'sport' =>'required',
      ]);
        $user = Auth::user();
        $sid =$request->input('sport');
        $role=$request->input('role');
        $user->sports()->attach($sid,['role'=>$role]);
      return redirect('dashboard')->with('success','Sport Added');
    }
      public function deletesport($id){
          $user = Auth::user();
            $user->sports()->detach($id);
            return redirect('dashboard')->with('success','Sport Removed');
      }
}
