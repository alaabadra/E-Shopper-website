
@extends('layout')

@section('title')
    Category Page
@endsection

@section('content')
<style>
  /* .form-group{
    width: 24%;
    margin-left: 490px;
  } */
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
<h1 style="margin-left: 582px;"> CONTACT PAGE</h1>

<form action="{{url('/page-contact')}}" method="post"style="    margin-top: 25px;
    margin-left: 122px;">
<div class="form-group">{{csrf_field()}}
<div id="app">

      <!-- @{{ testmsg }} -->
</div>
    <label for="name"class="form-label">name</label>
    <input type="text" class="form-control" id="name" placeholder="name" name="name">
  </div>
<div class="form-group">
    <label for="email"class="form-label">email</label>
    <input type="text" class="form-control" id="email" placeholder="email" name="email">
  </div>
  <div class="form-group">
    <label for="subject"class="form-label">subject</label>
    <input type="text" class="form-control" id="subject" placeholder="subject" name="subject">
  </div>

  <div class="form-group">
    <label for="message"class="form-label">message</label>
    <input type="text" class="form-control" id="message" placeholder="message" name="message">
  </div>




  <button type="submit" class="btn btn-primary"style=" margin-left: 492px;
    width: 24%;">Add</button>
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
@endsection