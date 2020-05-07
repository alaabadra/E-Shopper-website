
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
<h1 style="    margin-left: 589px;">Add Admin Page</h1>

<form action="{{url('/admin/add-admin/')}}" method="post" enctype="multipart/form-data"style="margin-top: 69px;
    margin-left: 122px;">{{csrf_field()}}
<div class="form-group">
    <label for="email"class="form-label">email</label>
    <input type="text" class="form-control" id="email" placeholder="email"name="email"  >
  </div>

  <div class="form-group">
    <label for="name"class="form-label">name</label>
    <input type="name" class="form-control" id="name" placeholder="name" name="name"  >
  </div>

  <div class="form-group">
    <label for="password"class="form-label">password</label>
    <input type="password" class="form-control" id="password" placeholder="password" name="password" >
  </div>

  <div class="form-group">
    <label for="type"class="form-label">type</label>
    <input type="type" class="form-control" id="type" placeholder="type" name="type" >
  </div>



  <div class="form-group">
    <label for="status"class="form-label">status</label>
    <input type="status" class="form-control" id="status" placeholder="status" name="status" >
  </div>

  <div class="form-group">
    <label for="categories_full_access"class="form-label">categories full access</label>
    <input type="categories_full_access" class="form-control" id="categories_full_access" placeholder="categories_full_access" name="categories_full_access" >
  </div>

  <div class="form-group">
    <label for="categories_view_access"class="form-label">categories view access</label>
    <input type="categories_view_access" class="form-control" id="categories_view_access" placeholder="categories_view_access" name="categories_view_access" >
  </div>

  <div class="form-group">
    <label for="categories_edit_access"class="form-label">categories edit access</label>
    <input type="categories_edit_access" class="form-control" id="categories_edit_access" placeholder="categories_edit_access" name="categories_edit_access" >
  </div>

  <div class="form-group">
    <label for="products_access"class="form-label">products access</label>
    <input type="products_access" class="form-control" id="products_access" placeholder="products_access" name="products_access" >
  </div>

  <div class="form-group">
    <label for="orders_access"class="form-label">orders access</label>
    <input type="orders_access" class="form-control" id="orders_access" placeholder="orders_access" name="orders_access">
  </div>

  <div class="form-group">
    <label for="users_access"class="form-label">users access</label>
    <input type="users_access" class="form-control" id="users_access" placeholder="categories_full_access" name="users_access">
  </div>


  <button type="submit" class="btn btn-primary"style="    margin-left: 490px;
    width: 24%;">add </button>
</form>
@endsection