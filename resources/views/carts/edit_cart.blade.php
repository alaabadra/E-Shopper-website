@extends('layout')
@section('title')
    EDIT CART Page
@endsection
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
<h1 style="    margin-left: 589px;">Edit Cart Page</h1>
<form action="{{url('/edit-cart/'.$oneCart->id)}}" method="post">
<div class="form-group">{{csrf_field()}}
    <label for="product_id" class="form-label">product Id</label>
    <input type="text" class="form-control" id="product_id" placeholder="product_id" name="product_id" value='{{$oneCart->product_id}}'name="product_id" >
  </div>
<div class="form-group">
    <label for="product_name" class="form-label">product Name</label>
    <input type="product_name" class="form-control" id="product_name" placeholder="product_name"value='{{$oneCart->product_name}}' name="product_name" >
  </div>
  <div class="form-group">
    <label for="product_size" class="form-label">product Size</label>
    <input type="product_size" class="form-control" id="product_size" placeholder="product_size"value='{{$oneCart->product_size}}'name="product_size">
  </div>
  <div class="form-group">
    <label for="product_price" class="form-label">product Price</label>
    <input type="product_price" class="form-control" id="product_price" placeholder="product_price"value='{{$oneCart->product_price}}'name="product_price">
  </div>

  <div class="form-group">
    <label for="product_code" class="form-label">product Code</label>
    <input type="product_code" class="form-control" id="product_code" placeholder="product_code"value='{{$oneCart->product_code}}'name="product_code">
  </div>

  <div class="form-group">
    <label for="product_color" class="form-label">product Color</label>
    <input type="product_color" class="form-control" id="product_color" placeholder="product_color"value='{{$oneCart->product_color}}'name="product_color">
  </div>

  <div class="form-group">
    <label for="product_status" class="form-label">product Status</label>
    <input type="product_status" class="form-control" id="product_status" placeholder="product_status"value='{{$oneCart->product_status}}'name="product_status">
  </div>
  
  <div class="form-group">
    <label for="user_email" class="form-label">user Email</label>
    <input type="user_email" class="form-control" id="user_email" placeholder="user_email"value='{{$oneCart->user_email}}'name="user_email">
  </div>

  <button type="submit" class="btn btn-primary"style="margin-left: 490px;
    width: 24%;">edit</button>
</form>
@endsection