
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
<h1 style="       margin-left: 380px;">Edit  product  ({{$editProd->product_name}}) </h1>

<form action="{{url('/edit-product/'.$editProd->id)}}" method="post"style="margin-top: 69px;
    margin-left: 122px;">{{csrf_field()}}
<div class="form-group">

    <label for="category_id"class="form-label">Category this product</label>
    
    <select name="category_id" id="" class="form-control">

    <?php echo $dropdown?>
    </select>
     </div>
  <div class="form-group">
    <label for="product_name"class="form-label">Product Name</label>
    <input name="product_name" class="form-control" id="product_name" placeholder="product_name" value="{{$editProd->product_name}}">
  </div>
  <div class="form-group">
    <label for="product_image"class="form-label">Product Image</label>
    <input name="product_image" class="form-control" id="product_image" placeholder="product_image"value='{{$editProd->product_image}}'>
  </div>


<div class="form-group">
    <label for="product_status"class="form-label" >Product Status</label>
    <select name="product_status" id="" class="form-control"  @if($editProd->product_status==1) selected @endif >
        <option>0</option>
        <option>1</option>
        <option>2</option>
 
    </select>
  </div>



  <button name="submit" class="btn btn-primary"style="     margin-left: 492px;
    width: 24%;">EDIT</button>
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