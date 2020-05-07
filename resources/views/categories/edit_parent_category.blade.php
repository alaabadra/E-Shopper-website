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
<h1 style="    margin-left: 589px;">Edit Parent Category {{$editCat->category_name}} </h1>

<form action="{{url('/edit-parent-category/'.$editCat->id)}}" method="post"style="margin-top: 69px;
    margin-left: 122px;">{{csrf_field()}}
<div class="form-group">
    <input type="hidden" class="form-control" id="id" placeholder="id" name="id" value="{{$editCat->id}}">

  <div class="form-group">
    <label for="category_name"class="form-label">category Name</label>
    <input name="category_name" class="form-control" id="category_name" placeholder="category_name" value="{{$editCat->category_name}}">
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
          </ul>
        </div>
        </form>
        @endif
</form>

@endsection