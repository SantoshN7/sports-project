@extends('layouts.base')

@section('content')
<div class="container">
  <form action="{{ action('TeamController@create') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
    @csrf
  <h4 class="text-upperclass">Create Team:</h4>
          <div class="jumbotron">
            <div class="row">
              <div class="col-md-4">
          <img src="/media/team.png" class="img-responsive img-circle" style="width:180px; height:180px; border-radius:50%;">
          <input type="file" name="avatar">
        </div>
          <div class="col-md-4 form-group">
            <label class="control-label col-sm-2">TeamName:</label>
             <div class="col-sm-10">
               <input type="text" name="name" class="form-control">
             </div>
             <label class="control-label col-sm-2">TeamType</label>
               <select class="form-control" name="type">
                 <option></option>
                 <option value="Casual">Casual</option>
                 <option value="Competitive">Competitive</option>
               </select>
           </div>
          </div>
        </div>
          <input type="submit" value="Create" class="btn btn-success">
          </form>
        </div>
@endsection
