@extends('layouts.base')

@section('content')
<div class="container">
  @foreach($players as $player)
  <div class="jumbotron">
    <div class="row ">
        <div class="col-md-3">
          <div class="col-sm-6">
          <img src="/media/avatars/{{$player->avatar}}" class="img-responsive img-circle" style="width:80px; height:80px; border-radius:50%;">
        </div>
        <div class="col-sm-6">
          <h6>{{$player->name}}</h6>
        </div>
        </div>
        <div class="col-md-6">
          <label class="control-label ">Email:</label>
          <label class="control-label ">{{$player->email}}</label><br>
          <label class="control-label ">Age:</label>
          <label class="control-label ">
{{\Carbon\Carbon::parse($player->birthdate)->diff(\Carbon\Carbon::now())->format('%y years')}}</label><br>
          <label class="control-label ">Gender:</label>
          <label class="control-label ">{{$player->gender}}</label>
        </div>
        <div class="col-md-3">
          <a href="requestTU/{{$player->id}}"  class="btn btn-primary">Send Request</a>
        </div>
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
          <button type="button"  class="btn btn-info" data-toggle="collapse" data-target="#{{$player->id}}">Sports Info</button>
          <div id="{{$player->id}}" class="collapse">
            <hr>
            <?php
                $user_sports =  App\User::find($player->id)->sports
            ?>
            @if(count($user_sports)>0)
            <table class="table table-striped">
              <tr>
                <th>Sport</th>
                <th>Role</th>
              </tr>
              @foreach($user_sports as $user_sport)
              <tr>
                <td>{{$user_sport->name}}</td>
                <td>{{$user_sport->pivot->role}}</td>
              </tr>
              @endforeach
            </table>
            @else
            <small>no sport selected by player</small>
            @endif
  </div>
        </div>
    </div>
  </div>
  @endforeach
</div>


@endsection
