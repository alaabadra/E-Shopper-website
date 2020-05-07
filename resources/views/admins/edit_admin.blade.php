
@extends('layout')

@section('title')
    EDIT ADMIN Page
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
<h1 style="    margin-left: 589px;">Edit Admin Page</h1>

<form action="{{url('/admin/edit-admin/'.$editAdmin->id)}}" method="post" enctype="multipart/form-data"style="margin-top: 69px;
    margin-left: 122px;">{{csrf_field()}}
    <?php
$decPass= Crypt::decryptString($editAdmin->password);

    ?>
<div class="form-group">
    <label for="email"class="form-label">email</label>
    <input type="text"name="email" class="form-control" id="email" placeholder="email"name="email"  value="{{$editAdmin->email}}">
  </div>

  <div class="form-group">
    <label for="name"class="form-label">name</label>
    <input type="text" class="form-control" id="name" placeholder="name" name="name" value="{{$editAdmin->name}}" >
  </div>

  <div class="form-group">
    <label for="password"class="form-label">password</label>
    <input type="text"name="password" class="form-control" id="password" placeholder="password"  value="{{$decPass}}">
  </div>

  <div class="form-group">
    <label for="type"class="form-label">type</label>
    <input type="text" name="type" class="form-control" id="type" placeholder="type"  value="{{$editAdmin->type}}">
  </div>



  <div class="form-group">
    <label for="status"class="form-label">status</label>
    <input type="text"name="status" class="form-control" id="status" placeholder="status" value="{{$editAdmin->status}}">
  </div>



  <div class="form-group">
    <label for="categories_edit_access"class="form-label">categories edit access</label>
    <input type="text" name="categories_edit_access"class="form-control" id="categories_edit_access" placeholder="categories_edit_access"  value="{{$editAdmin->categories_edit_access}}">
  </div>

  <div class="form-group">
    <label for="products_access"class="form-label">products access</label>
    <input type="text" name="products_access"class="form-control" id="products_access" placeholder="products_access"  value="{{$editAdmin->products_access}}">
  </div>

  <div class="form-group">
    <label for="carts_access"class="form-label">carts access</label>
    <input type="text" name="carts_access" class="form-control" id="carts_access" placeholder="carts_access"  value="{{$editAdmin->carts_access}}">
  </div>

  <div class="form-group">
    <label for="users_access"class="form-label">users access</label>
    <input type="text" name="users_access" class="form-control" id="users_access" placeholder="categories_full_access"  value="{{$editAdmin->users_access}}">
  </div>


  <button type="submit" class="btn btn-primary"style="    margin-left: 490px;
    width: 24%;">edit </button>
</form>
@endsection