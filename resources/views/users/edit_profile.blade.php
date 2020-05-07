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
  .header{
  margin-top: 43px;
    font-family: fantasy;
}
.header:hover{
  color:#ff00bc;
}
</style>
<div class="header">

<h1 style="      margin-left: 652px;
    margin-top: 24px;">Edit Your Profile</h1>
</div>
<form action="{{url('/edit-profile/'.$dataThisUser->id)}}" method="post"enctype="multipart/form-data"style="margin-top: 69px;
    margin-left: 122px;">{{csrf_field()}}
<div class="form-group">
    <input type="hidden" class="form-control" id="id" placeholder="id" name="id" value="{{$dataThisUser->id}}">

    

  <div class="form-group">
  <label for="name" class="form-label"><b>name</b></label>
    <input name="name" class="form-control" id="name" placeholder="name" value="{{$dataThisUser->name}}">
  </div>
  <div class="form-group">
  <label for="email"class="form-label"><b>email</b></label>
    <input name="email" class="form-control" id="email" placeholder="email"value="{{$dataThisUser->email}}">
  </div>



  <div class="form-group">
  <label for="pincode"class="form-label"><b>pincode</b></label>
    <input name="pincode" class="form-control" id="pincode" placeholder="pincode"value="{{$dataThisUser->pincode}}">
  </div>

  <div class="form-group">
  <label for="city"class="form-label"><b>city</b></label>

    <input name="city" class="form-control" id="city" placeholder="city"value="{{$dataThisUser->city}}">
  </div>

  <div class="form-group">
  <label for="state"class="form-label"><b>state</b></label>

    <input name="state" class="form-control" id="state" placeholder="state"value="{{$dataThisUser->state}}">
  </div>
  <div class="form-group">
  <label for="mobile"class="form-label"><b>mobile</b></label>

    <input name="mobile" class="form-control" id="mobile" placeholder="mobile"value="{{$dataThisUser->mobile}}">
  </div>
  <div class="form-group">
  <label for="address"class="form-label"><b>address</b></label>

    <input name="address" class="form-control" id="address" placeholder="address"value="{{$dataThisUser->address}}">
  </div>

  <div class="form-group">
  <label for="password"class="form-label"><b>password</b></label>

    <input class="form-control" id="password" placeholder="password"value="{{$userPassDec}}" disabled>
  </div>
<div class="form-group">
    <label for="country" class="form-label">country</label>
      <select name="country" id="" class="form-control">
                         <option value="">countries</option>
                         @foreach($getCountries as $country)

                         <option  value="{{$country->country}}" @if($country->country_name==$dataThisUser->country) selected @endif >{{$country->country}}</option>
                         @endforeach
                         </select>
</div>
                        



  <button name="submit" class="btn btn-primary" style="    margin-left: 516px;">update my profile</button>
  <a target="_blank" href="{{url('update-password/'.$dataThisUser->id)}}"class="btn btn-primary" >update  my password</a><br>

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