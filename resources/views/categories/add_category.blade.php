@extends('layout')
@section('title')
    EDIT PARENT CATEGORY Page
@endsection
@section('content')
<style>
  .form-label{
    width: 24%;
    margin-left: 490px;
  }
  .form-control{
    width: 24%;
    margin-left: 490px;
    
  }
</style>
<h1 style="    margin-left: 589px;">Add Category Page</h1>

<form action="{{url('/add-category/')}}" method="post"style="margin-top: 69px;
    margin-left: 122px;"enctype="multipart/form-data">{{csrf_field()}}


  <div class="form-group">
    <label for="category_name"class="form-label">category Name</label>
    <input name="category_name" class="form-control" id="category_name" placeholder="category_name">


  </div>
  <div class="panel panel-warning" style="margin-left: 488px;
    width: 24%;">
      <div class="panel-heading">for category inside this category</div>
    </div>
  <div class="form-group">
    <label for="category_url"class="form-label">category Url</label>
    <input name="category_url" class="form-control" id="category_url" placeholder="category_url">
  </div>
  <div class="form-group">
    <label for="category_sub_image"class="form-label">Sub Category  Image</label>
    <input name="category_sub_image" class="form-control" id="category_sub_image" placeholder="category_sub_image" type="file">
  </div>
    <div class="form-group">
    <label for="category_status"class="form-label" >category Status</label>
    <select name="category_status" id="" class="form-control">
        <option>0</option>
        <option>1</option>
        <option>2</option>
 
    </select>
  </div>
  <div class="form-group">
    <label for="products_quantity"class="form-label" >products Quantity</label>
  <input type="integer" name="products_quantity" id="" class="form-control" >
  </div>
  
  <button name="submit" class="btn btn-primary"style=" margin-left: 492px;
    width: 24%;">Add</button>
      @if(empty($errors))
      <div style="background-color:white"></div>
      @else
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
          </ul>
        </div>
        </form>
        @endif
      @endif

@endsection