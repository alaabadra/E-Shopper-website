
@extends('layout')


@section('content')
<style>
       body{
        margin:0;
        padding:0;
        background-color:#ffefef;
    }
</style>
<form action="{{url('/add-to-my-fav/'.$productId)}}" method="post" enctype="multipart/form-data">
<?php echo  'hdhj'.$productId?>
<div class="form-group">{{csrf_field()}}
    <label for="product_id">Product Id</label>
    <input type="text" class="form-control" id="product_id" placeholder="id"name="product_id">
  </div>

  <div class="form-group">
    <label for="product_name">Product Name</label>
    <input type="product_name" class="form-control" id="product_name" placeholder="product_name" name="product_name">
  </div>

  <div class="form-group">
    <label for="product_code">Product Code</label>
    <input type="product_code" class="form-control" id="product_code" placeholder="product_code" name="product_code">
  </div>

  <div class="form-group">
    <label for="product_color">Product Color</label>
    <input type="product_color" class="form-control" id="product_color" placeholder="product_code" name="product_color">
  </div>



  <div class="form-group">
    <label for="price">Price</label>
    <input type="price" class="form-control" id="price" placeholder="price" name="price">
  </div>

  <div class="form-group">
    <label for="quantity">Quantity</label>
    <input type="quantity" class="form-control" id="quantity" placeholder="quantity" name="quantity">
  </div>

  <div class="form-group">
    <label for="user_email">User Email</label>
    <input type="user_email" class="form-control" id="user_email" placeholder="user_email" name="user_email">
  </div>

  <button type="submit" class="btn btn-primary">Add</button>
</form>
@endsection