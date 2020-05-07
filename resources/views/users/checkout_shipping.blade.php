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

<h1 style="margin-left: 589px;">CHECKOUT SHIPPING</h1>
</div>
<form action="{{url('/checkout-shipping/'.$user->id)}}" method="post"style="    margin-top: 25px;
    margin-left: 122px;">{{csrf_field()}}

  <div class="form-group">
    <label for="email_shipping"class="form-label">email Shipping</label>
    <input name="email_shipping" class="form-control" id="email_shipping" placeholder="email_shipping"value="{{$user->email}}" >
  </div>

  <div class="form-group">
  <label for="name_shipping"class="form-label">name Shipping</label>

    <input name="name_shipping" class="form-control" id="name_shipping" placeholder="name_shipping"value="{{$user->name}}">
  </div>

  <div class="form-group">
  <label for="pincode_shipping"class="form-label">pincode Shipping</label>

    <input name="pincode_shipping" class="form-control" id="pincode_shipping" placeholder="pincode_shipping"value="{{$user->pincode}}">
  </div>

  <div class="form-group">
  <label for="state_shipping"class="form-label">state Shipping</label>

    <input name="state_shipping" class="form-control" id="state_shipping" placeholder="state_shipping"value="{{$user->city}}">
  </div>

  <div class="form-group">
  <label for="city_shipping"class="form-label">city Shipping</label>

    <input name="city_shipping" class="form-control" id="city_shipping" placeholder="city_shipping"value="{{$user->state}}">
  </div>
  <div class="form-group">
  <label for="address_shipping"class="form-label">address Shipping</label>

    <input name="address_shipping" class="form-control" id="addresses_shipping" placeholder="addresses_shipping"value="{{$user->address}}">
  </div>
  <div class="form-group">
  <label for="mobile_shipping"class="form-label">mobile Shipping</label>

    <input name="mobile_shipping" class="form-control" id="mobile_shipping" placeholder="mobile_shipping"value="{{$user->mobile}}">
  </div>



      </select>
    <label for="country_shipping"class="form-label">country Shipping</label>

      <select name="country_name" id="" class="form-control">
                         <option value="">countries</option>
                         @foreach($getCountries as $country)

                         <option   value="{{$country->country_name}}" @if($country->country_name==$user->country) selected @endif  >{{$country->country_name}}</option>
                         @endforeach
                         </select>



  <button name="submit" class="btn btn-primary"style=" margin-left: 492px;
    width: 24%;">SHIPPING</button>

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