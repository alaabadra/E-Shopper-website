
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
  
<h1  style="    margin-left: 352px;">
 PAGE Add details into  {{$productName}}
 </h1>
<form action="{{url('/add-details-product/'.$productId)}}" method="post" enctype="multipart/form-data"style="margin-top: 69px;
    margin-left: 122px;">
{{csrf_field()}}
  <div class="form-group">
<div class="alert alert-warning" role="alert" style="width: 19%;
    margin-left: 519px;">
<h5>you shouldnt add in this input product name </h5>
  
</div>
    <label for="product_name"class="form-label">Product Name</label>
    <input type="product_name" class="form-control" id="product_name" placeholder="product_name" name="product_name" value="{{$productName}}">
  </div>
  <div class="form-group">
    <label for="product_image"class="form-label">Product Image</label>
    <input type="file" name="product_image" id="" style="    margin-left: 491px;" class="form-control">

  </div>
  <div class="form-group">
    <label for="product_size"class="form-label">Product Size</label>
    <input type="text" name="product_size" id="" style="    margin-left: 491px;"class="form-control">

  </div>
  <div class="form-group">
    <label for="product_price"class="form-label">Product Price</label>
    <input type="product_price" class="form-control" id="product_price" placeholder="product_price" name="product_price">
  </div>
  <div class="form-group">
    <label for="product_color"class="form-label">Product Color</label>
    <input type="product_color" class="form-control" id="product_color" placeholder="product_color" name="product_color">
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