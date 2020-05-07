
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
<h1 style="    margin-left: 589px;">Add User Page</h1>

<form action="{{url('/admin/add-user/')}}" method="post" enctype="multipart/form-data"style="margin-top: 69px;
    margin-left: 122px;">{{csrf_field()}}
<div class="form-group">
    <label for="email"class="form-label">email</label>
    <input type="text" class="form-control" id="email" placeholder="email"name="email">
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
    <label for="city"class="form-label">city</label>
    <input type="city" class="form-control" id="city" placeholder="city" name="city" >
  </div>

  <div class="form-group">
    <label for="mobile"class="form-label">mobile</label>
    <input type="mobile" class="form-control" id="mobile" placeholder="mobile" name="mobile" >
  </div>

  <div class="form-group">
                        <select name="country_name" id="" class="form-control">
        <option value="0">country</option>
    @foreach($getCountries as $country)
        <option value="{{$country->id}}">{{$country->country_name}}</option> 
    @endforeach
      </select>

                        
                        </div>
  <div class="form-group">
    <label for="pincode"class="form-label">pincode</label>
    <input type="pincode" class="form-control" id="pincode" placeholder="pincode" name="pincode" >
  </div>



  <div class="form-group">
    <label for="state"class="form-label">state</label>
    <input type="state" class="form-control" id="state" placeholder="state" name="state">
  </div>

  <div class="form-group">
    <label for="address"class="form-label">address</label>
    <input type="address" class="form-control" id="address" placeholder="address" name="address" >
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