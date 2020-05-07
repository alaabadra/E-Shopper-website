@extends('layout')

@section('title')
    Category Page
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
<h1 style="     margin-left: 433px;">edit sub Category ({{$editCat->category_name}}) </h1>

<form action="{{url('/edit-sub-category/'.$editCat->id)}}" method="post"style="margin-top: 69px;
    margin-left: 122px;">{{csrf_field()}}
<div class="form-group">
   
    <label for="id"class="form-label">parent category</label>
    <select name="parent_id" id=""class="form-control">
    <option value="0">parents</option>
    @foreach($parentsCats as $parentCat)
    <option  value="{{$parentCat->parent_id}}" @if($parentCat->parent_id == $editCat->id) selected @endif >{{$parentCat->category_name}}</option>
    @endforeach
    </select>
  <div class="form-group">
    <label for="category_name"class="form-label">category Name</label>
    <input name="category_name" class="form-control" id="category_name" placeholder="category_name" value="{{$editCat->category_name}}">
  </div>
  <div class="form-group">
    <label for="category_image"class="form-label">category Image</label>
    
    <input name="category_image" class="form-control" id="category_image" placeholder="category_image"value="{{$editCat->category_image}}">
  </div>

  <div class="form-group">
    <label for="category_url"class="form-label">category Url</label>
    <input name="category_url" class="form-control" id="category_url" placeholder="category_url"value='{{$editCat->category_url}}'>
  </div>
    <div class="form-group">
    <label for="category_status"class="form-label" >category Status</label>
    <select name="category_status" id="" class="form-control">
        <option>0</option>
        <option>1</option>
        <option>2</option>
 
    </select>
  </div>
  <button name="submit" class="btn btn-primary"style="     margin-left: 492px;
    width: 24%;">Edit</button>
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