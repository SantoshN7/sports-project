@extends('layouts.base')

@section('content')
<div class="container">
  <h4 class="text-upperclass">Notifications</h4>
  @if(count($notifications)>0)
@foreach($notifications as $notification)
<div class="jumbotron p-3" >
  @if($notification->type == "requestUT")
  <?php
      $sender =  App\User::find($notification->sender_id);
  ?>
  <div class="row">
    <div class="col-sm-2">
  <img src="/media/avatars/{{$sender->avatar}}" class="img-responsive img-circle" style="width:40px; height:40px; border-radius:50%;">
    </div>
    <div class="col-sm-6">
  <h6>{{$sender->name}} wants to join your TEAM.</h6>
</div>
<div class="col-sm-4">
  <a href="ADDTOTEAM/{{$sender->id}}" class="btn btn-success">Accept</a>
  <a href="DECLINE/{{$sender->id}}" class="btn btn-danger">Decline</a>
</div>
</div>
@elseif($notification->type == "requestTU")
<?php
    $sender =  App\Team::find($notification->sender_id);
?>
<div class="row">
  <div class="col-sm-2">
<img src="/media/teamavatars/{{$sender->logo}}" class="img-responsive img-circle" style="width:40px; height:40px; border-radius:50%;">
  </div>
  <div class="col-sm-6">
<h6>{{$sender->name}} wants you to join there TEAM.</h6>
</div>
<div class="col-sm-4">
<a href="JOINTEAM/{{$sender->id}}" class="btn btn-success">Accept</a>
<a href="hide/{{$notification->id}}" class="btn btn-danger">Decline</a>
</div>
</div>
@elseif($notification->type == "acceptTU")
<?php
    $sender =  App\Team::find($notification->sender_id);
?>
<div class="row">
  <div class="col-sm-2">
<img src="/media/teamavatars/{{$sender->logo}}" class="img-responsive img-circle" style="width:40px; height:40px; border-radius:50%;">
  </div>
  <div class="col-sm-7">
<h6>Your request to join {{$sender->name}} has been accepted.Your now Member of {{$sender->name}}. </h6>
</div>
<div class="col-sm-3">
<a href="hide/{{$notification->id}}" class="btn btn-success">Hide</a>
</div>
</div>
@elseif($notification->type == "declineTU")
<?php
    $sender =  App\Team::find($notification->sender_id);
?>
<div class="row">
  <div class="col-sm-2">
<img src="/media/teamavatars/{{$sender->logo}}" class="img-responsive img-circle" style="width:40px; height:40px; border-radius:50%;">
  </div>
  <div class="col-sm-7">
<h6>Your request to join {{$sender->name}} has been decline. </h6>
</div>
<div class="col-sm-3">
<a href="hide/{{$notification->id}}" class="btn btn-success">Hide</a>
</div>
</div>

@elseif($notification->type == "kick")
<?php
    $sender =  App\Team::find($notification->sender_id);
?>
<div class="row">
  <div class="col-sm-2">
<img src="/media/teamavatars/{{$sender->logo}}" class="img-responsive img-circle" style="width:40px; height:40px; border-radius:50%;">
  </div>
  <div class="col-sm-7">
<h6>You have been kicked from {{$sender->name}}. </h6>
</div>
<div class="col-sm-3">
<a href="hide/{{$notification->id}}" class="btn btn-success">Hide</a>
</div>
</div>
@elseif($notification->type == "leader")
<?php
    $sender =  App\Team::find($notification->sender_id);
?>
<div class="row">
  <div class="col-sm-2">
<img src="/media/teamavatars/{{$sender->logo}}" class="img-responsive img-circle" style="width:40px; height:40px; border-radius:50%;">
  </div>
  <div class="col-sm-7">
<h6>You are now leader of {{$sender->name}}. </h6>
</div>
<div class="col-sm-3">
<a href="hide/{{$notification->id}}" class="btn btn-success">Hide</a>
</div>
</div>
  @endif
</div>
@endforeach
@else
<hr>
<small>no notifications</small>
@endif
</div>
@endsection
