
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

<h1 style="margin-left: 620px;"> CHECKOUT BILLING</h1>
</div>
<form action="{{url('/checkout-billing/'.$user->id)}}" method="post"style="    margin-top: 25px;
    margin-left: 122px;">{{csrf_field()}}
<div class="form-group">

  <div class="form-group">
  <label for="email_billing"class="form-label">email Billing</label>


    <input name="email_billing" class="form-control" id="email_billing" placeholder="email_billing"value="{{$user->email}}">
  </div>

  <div class="form-group">
  <label for="name_billing"class="form-label">name Billing</label>

    <input name="name_billing" class="form-control" id="name_billing" placeholder="name_billing"value="{{$user->name}}">
  </div>

  <div class="form-group">
  <label for="pincode_billing"class="form-label">pincode Billing</label>

    <input name="pincode_billing" class="form-control" id="pincode_billing" placeholder="pincode_billing"value="{{$user->pincode}}">
  </div>

  <div class="form-group">
  <label for="state_billing"class="form-label">state Billing</label>

    <input name="state_billing" class="form-control" id="state_billing" placeholder="state_billing"value="{{$user->city}}">
  </div>

  <div class="form-group">
  <label for="city_billing"class="form-label">city Billing</label>

    <input name="city_billing" class="form-control" id="city_billing" placeholder="city_billing"value="{{$user->state}}">
  </div>
  <div class="form-group">
  <label for="adresses_billing"class="form-label">adresses Billing</label>

    <input name="address_billing" class="form-control" id="address_billing" placeholder="addresses_billing"value="{{$user->address}}">
  </div>
  <div class="form-group">
  <label for="mobile_billing"class="form-label">mobile Billing</label>

    <input name="mobile_billing" class="form-control" id="mobile_billing" placeholder="mobile_billing"value="{{$user->mobile}}">
  </div>



      </select>
  <label for="country_billing"class="form-label">country Billing</label>

      <select name="country_billing" id="" class="form-control">
                         <option value="">countries</option>
                         @foreach($getCountries as $country)

                         <option  value="{{$country->country_name}}" @if($country->country_name==$user->country_name) selected @endif >{{$country->country_name}}</option>
                         @endforeach
                         </select>



  <button name="submit" class="btn btn-primary"style=" margin-left: 492px;
    width: 24%;">BILLING</button>
</form>

@endsection
