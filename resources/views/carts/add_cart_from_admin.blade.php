@extends('layout')
@section('title')
    ADD CART  Page
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



<form action="{{url('/admin/add-cart/')}}" method="post"style="margin-top: 69px;
    margin-left: 122px;">
<div class="form-group">{{csrf_field()}}
<div class="form-group">
      <label for="email" class="form-label" >email</label>
      <input type="text" class="form-control" id="email" placeholder="email" name="email">
    </div>
    <label for="product_id"class="form-label" >product Id</label>
    <input type="number" class="form-control" id="product_id" placeholder="product_id" name="product_id" name="product_id" >
  </div>
<div class="form-group">
    <label for="product_name"class="form-label" >product Name</label>
    <input type="product_name" class="form-control" id="product_name" placeholder="product_name" name="product_name" >
  </div>
  <div class="form-group">
    <label for="product_size"class="form-label" >product Size</label>
    <input type="product_size" class="form-control" id="product_size" placeholder="product_size"name="product_size">
  </div>
  <div class="form-group">
    <label for="product_price"class="form-label" >product Price</label>
    <input type="product_price" class="form-control" id="product_price" placeholder="product_price"name="product_price">
  </div>

  <div class="form-group">
    <label for="product_code"class="form-label" >product Code</label>
    <input type="product_code" class="form-control" id="product_code" placeholder="product_code"name="product_code">
  </div>

  <div class="form-group">
    <label for="product_color"class="form-label" >product Color</label>
    <input type="product_color" class="form-control" id="product_color" placeholder="product_color"name="product_color">
  </div>

  <div class="form-group">
    <label class="control-label"class="form-label" style="margin-left: 493px;">enable</label>
    <div class="controls"style="    margin-left: 489px;">
    
    <input type="checkbox"  name="product_status"style="margin-left: 13px;
    margin-bottom: -10px;
    margin-top: -27px;"> 
    </div>
  
  </div>
  

  <button name="submit" class="btn btn-primary"style="     margin-left: 492px;
    width: 24%;">ADD</button>
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