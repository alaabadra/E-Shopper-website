@extends('layout')

@section('content')
<style>
       body{
        margin:0;
        padding:0;
        background-color:#ffefef;
    }
</style>
<form action="{{url('/edit-similar-product/'.$editSimProd->id)}}" method="post">
<div class="form-group">{{csrf_field()}}
    <label for="id">id</label>
    <input type="text" class="form-control" id="id" placeholder="id" value="{{$editSimProd->id}}">
  </div>
  <div class="form-group">
  <input type="text" name="product_id"value="{{$editSimProd->product_id}}">
  </div>
  <div class="form-group">
    <label for="product_name">product_name</label>
    <input type="product_name" class="form-control" id="product_name" placeholder="product_name" name="product_name"value="{{$editSimProd->product_name}}">
  </div>
  <div class="form-group">
    <label for="product_image">product_image</label>
    <input type="product_image" class="form-control" id="product_image" placeholder="product_image"name="product_image"value="{{$editSimProd->product_image}}">
  </div>


  <div class="form-group">
    <label for="product_status">product_status</label>
    <input type="product_status" class="form-control" id="product_status" placeholder="product_status" name="product_status"value="{{$editSimProd->product_status}}">
  </div>

  <button type="submit" class="btn btn-primary">Add</button>
</form>
@endsection