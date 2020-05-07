
@extends('layout')

@section('title')
    Category Page
@endsection

@section('content')
   
<!-- <form action="{{url('/contact')}}" method="post"> -->
<form method="post" v-on:submit.prevent="addPost">
<div class="form-group">{{csrf_field()}}
<!-- <div id="app">

      @{{ testmsg }}
</div> -->
<!-- <h2>post data via vue.js and Axios </h2> -->
<h2 id="app">   @{{ testmsg }}</h2>
    <label for="name">name</label>
    <!-- <input type="text" class="form-control" id="name" placeholder="name" name="name"> -->
    <input type="text" class="form-control" id="name" placeholder="name" v-model="name">
  </div>
<div class="form-group">
    <label for="email">email</label>
    <input type="email" class="form-control" id="email" placeholder="email" v-model="email">
  </div>
  <div class="form-group">
    <label for="subject">subject</label>
    <input type="text" class="form-control" id="subject" placeholder="subject" v-model="subject">
  </div>

  <div class="form-group">
    <label for="message">message</label>
    <input type="text" class="form-control" id="message" placeholder="message" v-model="message">
  </div>




  <button type="submit" class="btn btn-primary">Add</button>
</form>
@endsection