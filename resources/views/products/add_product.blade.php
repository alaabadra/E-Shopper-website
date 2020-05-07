
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
<form action="{{url('/add-product')}}" method="post" enctype="multipart/form-data"style="margin-top: 69px;
    margin-left: 122px;">
{{csrf_field()}}

  <label for="category_id" class="form-label">All Categories</label>
  <select name="category_id" id=""style="margin-left: 488px;" class="form-control">

<?php echo $dropdown?>
</select>
  <div class="form-group">
    <label for="product_name"class="form-label">Product Name</label>
    <input type="product_name" class="form-control" id="product_name" placeholder="product_name" name="product_name">
  </div>
  <div class="form-group">
    <label for="product_image"class="form-label">Product Image</label>
    <input type="file" name="product_image" id="" style="    margin-left: 491px;" class="form-control">

  </div>



  <!-- <div class="form-group"style="margin-left: 491px;">
    <label class="control-label"class="form-label">enable</label>
    <div class="controls">
    
    <input type="checkbox"  name="product_status" style="    margin-left: 6px;!important;"/> 
    </div> -->

    <div class="form-group">
    <label for="product_status"class="form-label" >Product Status</label>
    <select name="product_status" id="" class="form-control">
        <option>0</option>
        <option>1</option>
        <option>2</option>
 
    </select>
  </div>
  <div class="form-group">
    <label for="type"class="form-label" >Type</label>
    <select name="type" id="" class="form-control">
        <option>shoes</option>
        <option>t-shirt</option>
        <option>bags</option>
        <option>dress</option>
        <option>makeups</option>
 
    </select>
  </div>

  <div class="form-group">
    <label for="feature"class="form-label" >feature</label>
    <select name="feature" id="" class="form-control">
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
        <option>6</option>
        <option>7</option>
        <option>8</option>
        <option>9</option>
        <option>10</option>

 
    </select>
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