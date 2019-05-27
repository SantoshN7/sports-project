@extends('layouts.base')

@section('content')
<div class="container">
  @foreach($teams as $team)
  <div class="jumbotron ">
    <div class="row ">
        <div class="col-md-3">
          <div class="col-sm-6">
          <img src="/media/teamavatars/{{$team->logo}}" class="img-responsive img-circle" style="width:80px; height:80px; border-radius:50%;">
        </div>
        <div class="col-sm-6">
          <h6>{{$team->name}}</h6>
        </div>
        </div>
          <div class="col-md-6">
            <label class="control-label ">Team Type:</label>
            <label class="control-label ">{{$team->type}}</label><br>
              </div>
              <div class="col-md-3">
                <a href="requestUT/{{$team->id}}" class="btn btn-primary">Send Request</a>
              </div>
              <div class="col-md-3">
              </div>
              <div class="col-md-6">
            <button type="button"  class="btn btn-warning" data-toggle="collapse" data-target="#{{$team->id}}">Sports Info</button>

            <div id="{{$team->id}}" class="collapse">
              <hr>
              <?php
                  $team_sports =  App\Team::find($team->id)->sports2
              ?>
              @if(count($team_sports)>0)
              <table class="table table-striped">
                <tr>
                  <th>Sport</th>
                </tr>
                @foreach($team_sports as $team_sport)
                <tr>
                  <td>{{$team_sport->name}}</td>
                </tr>
                @endforeach
              </table>
              @else
              <small>no sport selected by team</small>
              @endif
    </div>
  </div>
</div>
  </div>
  @endforeach
</div>
@endsection
