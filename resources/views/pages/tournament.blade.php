@extends('layouts.base')

@section('content')
<div class="container">
  <h4 class="text-upperclass">Upcoming Tournaments:</h4>
    @if(count($tournaments)>0)
    <table class="table table-striped">
      <tr>
      <th>Name</th>
      <th>Sport</th>
      <th>Price</th>
      <th>Location</th>
      <th>Tournament Day</th>
      <th>Registration closing in</th>
      <th></th>
    </tr>
    @foreach($tournaments as $tournament)
      <tr>
        <td>{{$tournament->name}}</td>
        <td>{{$tournament->sport}}</td>
        <td>{{$tournament->price}}</td>
        <td>{{$tournament->location}}</td>
        <td>{{$tournament->date}}</td>
        <td> {{\Carbon\Carbon::parse($tournament->date)->diff(\Carbon\Carbon::now())->format('%d days %h hours')}}</td>
        <td><a href="participate/{{$tournament->id}}" class="btn btn-success">Participate</a></td>
      </tr>
      @endforeach
    </table>
    @else
        <small>no upcoming tournaments</small>
    @endif
</div>
@endsection
