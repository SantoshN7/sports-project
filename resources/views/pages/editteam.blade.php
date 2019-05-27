@extends('layouts.base')

@section('content')
<div class="container">
  <form action="{{ action('TeamController@update') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
    @csrf
  <h4 class="text-upperclass">Team Information:</h4>
          <div class="jumbotron">
            <div class="row">
              <div class="col-md-4">
          <img src="/media/teamavatars/{{$team->logo}}" class="img-responsive img-circle" style="width:100px; height:100px; border-radius:50%;">
            <input type="file" name="avatar">
        </div>
          <div class="col-md-8 form-group">
             <input type="hidden" name="id" class="form-control" value="{{$team->id}}">
            <label class="control-label col-sm-2">TeamName:</label>
             <div class="col-sm-10">
               <input type="text" name="name" class="form-control" value="{{$team->name}}">
             </div>
      <label class="control-label col-sm-2" for="email">TeamType:</label>
       <div class="col-sm-10">
         <input type="text" name="type" class="form-control" value="{{$team->type}}">
       </div>
    </div>
  </div>
    <input type="submit" value="Update" class="btn btn-success">
        </div>
      </form>
      <h4 class="text-upperclass">Sports Information:</h4>
              <div class="jumbotron">
                <div class="container col-md-6 ">
                   <form action="{{ action('TeamController@addsport2') }}" method="post" class="form-horizontal">
                      @csrf
                      <input type="hidden" name="id" class="form-control" value="{{$team->id}}">
                      <div class="form-group">
                        <label class="control-label">Select Sport</label>
                          <select class="form-control" name="sport">
                            <option></option>
                            @foreach($sports as $sport)
                            <option value="{{$sport->id}}">{{$sport->name}}</option>
                            @endforeach
                          </select>
                      </div>
                      <input type="submit" value="Add" class="btn btn-primary">
                  </form>
                  <br>
                  <hr>
                  @if(count($team_sports)>0)
                  <table class="table table-striped">
                    <tr>
                      <th>Sport</th>
                      <th></th>
                    </tr>
                    @foreach($team_sports as $team_sport)
                    <tr>
                      <td>{{$team_sport->name}}</td>
                      <td><a href="/delete_sport2/{{$team_sport->id}}/{{$team->id}}" class="btn btn-danger">Delete</a></td>
                    </tr>
                    @endforeach
                  </table>
                  @endif
                </div>
              </div>
        <h4 class="text-upperclass">Team:</h4>
        <div class="jumbotron">
          @if(count($players)>0)
          <table class="table table-striped">
            <tr>
              <th>Name</th>
              <th>Status</th>
              <th></th>
              <th></th>
            </tr>
            @foreach($players as $player)
            <tr>
              <td>{{$player->name}}</td>
              <td>{{$player->pivot->status}}</td>
              @if($player->name!=Auth::user()->name)
                <td><a href="/makeleader/{{$player->id}}/{{$team->id}}" class="btn btn-info">Make Leader</a></td>
                  <td><a href="/kick/{{$player->id}}/{{$team->id}}" class="btn btn-danger">Kick Out</a></td>
                  @endif
            </tr>
            @endforeach
          </table>
          @else
            <small>no player in team</small>
          @endif
      </div>
@endsection
