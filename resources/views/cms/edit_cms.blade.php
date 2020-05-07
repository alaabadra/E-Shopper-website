@extends('layout')
@section('title')
    EDIT PARENT CATEGORY Page
@endsection
@section('content')
<style>
  .form-label{
    width: 24%;
    margin-left: 490px;
  }
  .form-control{
    width: 24%;
    margin-left: 490px;
    
  }
</style>
<h1 style="    margin-left: 589px;">Edit Cms Page</h1>

<form action="{{url('/edit-cms/'.$oneCms->id)}}" method="post"style="margin-top: 69px;
    margin-left: 122px;">{{csrf_field()}}

  <div class="form-group">
    <label for="title"class="form-label">title</label>
    <input name="title" class="form-control" id="title" placeholder="title" value="{{$oneCms->title}}">
  </div>
  <div class="form-group">
    <label for="description"class="form-label">description</label>
    <input name="description" class="form-control" id="description" placeholder="description"value="{{$oneCms->description}}">
  </div>

  <div class="form-group">
    <label for="url"class="form-label">url</label>
    <input name="url" class="form-control" id="url" placeholder="url"value='{{$oneCms->url}}'>
  </div>


  <div class="form-group" style="margin-left: 491px;">
    <label class="control-label"class="form-label">enable</label>
    <div class="controls">
    
    <input type="checkbox"  name="status" @if($oneCms->status==1) checked @endif /> 
    </div>
  <button name="submit" class="btn btn-primary"style="    margin-left: -1px;
    width: 37%;">Edit</button>
</form>

@endsection