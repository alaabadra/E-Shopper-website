@extends('layout')

@section('title')
    Category Page
@endsection

@section('content')
@if(Session::has('flash_message_error'))
    <div class="alert alert-error alert-block">
        <strong>{!!session('flash_message_error')!!}</strong>
    </div>
@endif

@if(Session::has('flash_message_success'))
    <div class="alert alert-success alert-block">
        <strong>{!!session('flash_message_success')!!}</strong>
    </div>
@endif
 <style> 
 /* Remove the jumbotron's default bottom margin */ 
     .jumbotron {
      margin-bottom: 0;
    }
    </style>
    
@foreach($getMainCats as $getCat)

<div class="container">    
  <div class="row">
    <div class="col-sm-4">
      <div class="panel panel-primary">
        <div class="panel">
    <h1><a  href="/get-sub-cats-for-users/{{$getCat->id}}">{{$getCat->category_name}}</a></h1>    
        </div>
        <div class="panel-body"><img src="https://i.pinimg.com/originals/02/12/d4/0212d4620214940a6b3d8b2ab5800915.jpg" class="img-responsive" style="width:100%" alt="Image">
    
        </div>
        <div class="panel-footer">{{$getCat->category_desc}}</div>
      </div>
    </div>
   @endforeach
</div><br><br>


@endsection

