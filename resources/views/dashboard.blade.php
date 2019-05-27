@extends('layouts.base')

@section('content')
<div class="container">
  <form action="{{ action('DashboardController@update') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
    @csrf
  <h4 class="text-upperclass">Personal Information:</h4>
          <div class="jumbotron">
            <div class="row">
              <div class="col-md-4">
          <img src="/media/avatars/{{Auth::user()->avatar}}" class="img-responsive img-circle" style="width:180px; height:180px; border-radius:50%;">
          <input type="file" name="avatar">
        </div>
          <div class="col-md-8 form-group">
            <label class="control-label col-sm-2">UserName:</label>
             <div class="col-sm-10">
               <input type="text" name="name" class="form-control" value="{{Auth::user()->name}}">
             </div>
      <label class="control-label col-sm-2" for="email">Email:</label>
       <div class="col-sm-10">
         <input type="email" name="email" class="form-control" value="{{Auth::user()->email}}">
       </div>
       <label class="control-label col-sm-2">ContactNo:</label>
        <div class="col-sm-10">
          <input type="text" name="phoneno" class="form-control" pattern="[1-9]{1}[0-9]{9}" value="{{Auth::user()->phoneno}}">
        </div>
        <label class="control-label col-sm-2">BirthDate:</label>
         <div class="col-sm-10">
           <input type="date" name="BirthDate" class="form-control" value="{{Auth::user()->birthdate}}">
         </div>
        <label class="control-label col-sm-2">Gender:</label>
        <input type="radio" name="gender" value="male" {{(Auth::user()->gender =='male')?'checked':''}}>Male
        <input type="radio" name="gender" value="female" {{(Auth::user()->gender =='female')?'checked':''}}>Female
        </div>
      </div>
      <input type="submit" value="Update" class="btn btn-success">
    </div>
      </form>
      <h4 class="text-upperclass">Sports Information:</h4>
              <div class="jumbotron">
                <div class="container col-md-6 ">
                   <form action="{{ action('DashboardController@addsport') }}" method="post" class="form-horizontal">
                      @csrf
                      <div class="form-group">
                        <label class="control-label">Select Sport</label>
                          <select class="form-control" name="sport">
                            <option></option>
                            @foreach($sports as $sport)
                            <option value="{{$sport->id}}">{{$sport->name}}</option>
                            @endforeach
                          </select>
                          <label class="control-label">Role:</label>
                           <div class="col-sm-10">
                             <input type="text" name="role" class="form-control">
                           </div>
                      </div>
                      <input type="submit" value="Add" class="btn btn-primary">
                  </form>
                  <br>
                  <hr>
                  @if(count($user_sports)>0)
                  <table class="table table-striped">
                    <tr>
                      <th>Sport</th>
                      <th>Role</th>
                      <th></th>
                    </tr>
                    @foreach($user_sports as $user_sport)
                    <tr>
                      <td>{{$user_sport->name}}</td>
                      <td>{{$user_sport->pivot->role}}</td>
                      <td><a href="delete_sport/{{$user_sport->id}}" class="btn btn-danger">Delete</a></td>
                    </tr>
                    @endforeach
                  </table>
                  @endif
                </div>
              </div>
        </div>

@endsection
