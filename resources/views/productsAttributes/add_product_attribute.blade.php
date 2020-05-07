@extends('layout')
@section('content')
<style>
       body{
        margin:0;
        padding:0;
        background-color:#ffefef;
    }
</style>
<form action="{{url('/add-product-attribute')}}" method="post"enctype="multipart/form-data">
{{csrf_field()}}

  
  <div class="form-group">
    <label for="product_id">Product Id</label>
      <select name="product_id" id="">
        <option value="products_names">Products Names</option>
    @foreach($ProductsAttributes as $prodAtt)
        <option value='".prodAtt->product_name."'>{{$prodAtt->product_name}}</option>
    @endforeach
      </select>
  </div>
  <div class="form-group">
    <label for="product_name">Product Name</label>
    <input type="text" class="form-control" id="product_name" placeholder="product_name"name="product_name">
  </div>
  <div class="form-group">
    <label for="product_image">Product Image</label>
    <input type="file" class="form-control" id="product_image" placeholder="product_image"name="product_image">
  </div>
  <div class="form-group">
    <label for="product_size">Product Size</label>
    <input type="text" class="form-control" id="product_size" placeholder="product_size"name="product_size">
  </div>
  <div class="form-group">
    <label for="product_price">Product Price</label>
    <input type="text" class="form-control" id="product_price" placeholder="product_price"name="product_price">
  </div>

  <div class="form-group">
    <label for="product_code">Product Code</label>
    <input type="text" class="form-control" id="product_code" placeholder="product_code"name="product_code">
  </div>

  <div class="form-group">
    <label for="product_color">Product Color</label>
    <input type="text" class="form-control" id="product_color" placeholder="product_color"name="product_color">
  </div>


  <div class="form-group">
    <label for="pincode">pincode</label>
    <input type="text" class="form-control" id="pincode" placeholder="pincode"name="pincode">
  </div>


  <div class="form-group">
    <label class="control-label">enable</label>
    <div class="controls">
    
    <input type="checkbox"  name="product_status" /> 
    </div>
  <button type="submit" class="btn btn-primary">Add</button>
</form>
<div class="alert alert-danger">
  <ul>
@if($errors->any())
  @foreach($errors->all() as $err)
    <li>{{$err}}</li>
  @endforeach
  </ul>
</div>
@endif
@endsection