@extends('layout')


@section('content')
<style>
       body{
        margin:0;
        padding:0;
        background-color:#ffefef;
    }
</style>
<form action="{{url('/edit-product-attribute/'.$editProdAtt->id)}}" method="post">{{csrf_field()}}
    <select name="product_id" id="">
        <option value="products_names">Products Names</option>
    @foreach($ProductsAttributes as $editProdAtt)
        <option value='".editProdAtt->product_name."'>{{$editProdAtt->product_name}}</option>
    @endforeach
      </select>
 
  <div class="form-group">
    <label for="product_name">Product Name</label>
    <input name="product_name" class="form-control" id="product_name" placeholder="product_name" value="{{$editProdAtt->product_name}}">
  </div>
  <div class="form-group">
    <label for="product_size">Product Size</label>
    <input name="product_size" class="form-control" id="product_size" placeholder="product_size"value="{{$editProdAtt->category_image}}">
  </div>

  <div class="form-group">
    <label for="product_price">Product Price</label>
    <input name="product_price" class="form-control" id="product_price" placeholder="product_price"value='{{$editProdAtt->product_price}}'>
  </div>
  <div class="form-group">
    <label for="product_code">Product Code</label>
    <input name="product_code" class="form-control" id="product_code" placeholder="product_code"value='{{$editProdAtt->product_code}}'>
  </div>
  <div class="form-group">
    <label for="product_color">product_color</label>
    <input name="product_color" class="form-control" id="product_color" placeholder="product_color"value='{{$editProdAtt->product_color}}'>
  </div>
  <div class="form-group">
    <label for="product_image">Product Image</label>
    <input name="product_image" class="form-control" id="product_image" placeholder="product_image"value='{{$editProdAtt->product_image}}'>
  </div>

  <div class="form-group">
    <label class="control-label">enable</label>
    <div class="controls">
    
    <input type="checkbox"  name="product_status" @if($editProdAtt->product_status==1) checked @endif /> 
    </div>
  <button name="submit" class="btn btn-primary">Edit</button>
</form>
@endsection