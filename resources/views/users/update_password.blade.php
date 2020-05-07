@extends('layout')
@section('content')
<style>
       body{
        margin:0;
        padding:0;
        background-color:#ffefef;
    }
    .form-label{
    width: 24%;
    margin-left: 490px;
  }
  .form-control{
    width: 24%;
    margin-left: 490px;
    
  }
</style>
<div style="margin-top: 49px;">

<h1 style="margin-left: 611px;"> Update My Password</h1>

<form action="{{url('/update-password/'.$dataThisUser->id)}}" method="post">{{csrf_field()}}
<div class="form-group" style="margin-left: 137px;
    margin-top: 60px;">
    <input type="hidden" class="form-control" id="id" placeholder="id" name="id" value="{{$dataThisUser->id}}">

    

  <div class="form-group">
    <label for="old_password" class="form-label">old Password</label>
    <input name="old_password" class="form-control" id="old_password" placeholder="old_password" >
  </div>
  <div class="form-group">
  <label for="new_password" class="form-label">new Password</label>
    <input name="new_password" class="form-control" id="new_password" placeholder="new_password">
  </div>






  <button name="submit" class="btn btn-primary"style=" margin-left: 492px;
    width: 24%;">update my password</button>
    <div class="alert alert-danger" style="    color: #a94442;
    background-color: #f2dede;
    border-color: #ebccd1;
    width: 24%;
    margin-left: 493px;
    margin-top: 0px;">
        <ul>
          @if($errors->any())
          @foreach($errors->all() as $err)
            <li>{{$err}}</li>
          @endforeach
          @endif
          </ul>
        </div>
</form>
</div>
@endsection