@extends('layouts.base')

@section('content')
<div class="container">
  <h4 class="text-upperclass">Team Information:</h4>
          <div class="jumbotron">
            <div class="row">
              <div class="col-md-4">
          <img src="/media/teamavatars/{{$team->logo}}" class="img-responsive img-circle" style="width:100px; height:100px; border-radius:50%;">
        </div>
          <div class="col-md-8 form-group">
            <label class="control-label col-sm-2">TeamName:</label>
            <label class="control-label ">{{$team->name}}</label><br>
            <label class="control-label col-sm-2">TeamType:</label>
            <label class="control-label ">{{$team->type}}</label>
    </div>
  </div>
        </div>
        <h4 class="text-upperclass">Team:</h4>
        <div class="jumbotron">
          @if(count($players)>0)
          <table class="table table-striped">
            <tr>
              <th>Name</th>
              <th>Status</th>
            </tr>
            @foreach($players as $player)
            <tr>
              <td>{{$player->name}}</td>
              <td>{{$player->pivot->status}}</td>
            </tr>
            @endforeach
          </table>
          @else
            <small>no player in team</small>
          @endif
      </div>
@endsection
