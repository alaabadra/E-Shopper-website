@extends('layout')

@section('title')
    Category Page
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
<h1 style="margin-left: 620px;"> EDIT  COUPON</h1>

<form action="{{url('/edit-coupon/'.$editCoupon->id)}}" method="post"style="    margin-top: 25px;
    margin-left: 122px;">
{{csrf_field()}}

  <div class="form-group">
  <label for="coupon_code" class="form-label">Coupon Code</label>

  <input type="text" name="coupon_code"value="{{$editCoupon->coupon_code}}" class="form-control">
  </div>
  <div class="form-group">
    <label for="amount"class="form-label">Mount</label>
    <input type="amount" class="form-control" id="amount" placeholder="amount" name="amount"value="{{$editCoupon->amount}}">
  </div>
  <div class="form-group">
    <label for="amount_type"class="form-label">Mount Type</label>
    <input type="amount_type" class="form-control" id="amount_type" placeholder="amount_type"name="amount_type"value="{{$editCoupon->amount_type}}">
  </div>


  <div class="form-group">
    <label for="expiry_date"class="form-label">Expiry Date</label>
    <input type="expiry_date" class="form-control" id="expiry_date" placeholder="expiry_date" name="expiry_date"value="{{$editCoupon->expiry_date}}">
  </div>

  <div class="form-group">
    <label for="email"class="form-label">Email</label>
    <input type="email" class="form-control" id="email" placeholder="email" name="email"value="{{$editCoupon->email}}">
  </div>

  <div class="form-group">
    <label class="form-label">enable</label>
    <div class="controls" style="margin-left:500px">
    
    <input type="checkbox"  name="status" @if($editCoupon->status==1) checked @endif /> 
    </div>

  <button type="submit" class="btn btn-primary"style=" margin-left: 492px;
    width: 24%;">edit</button>
</form>
<div class="alert alert-danger" style="    color: #a94442;
    background-color: #f2dede;
    border-color: #ebccd1;
    width: 24%;
    margin-left: 493px;
    margin-top: 0px;">
        <ul>
@if($errors->any())
    @foreach($errors->all() as $error)
      <li>{{$error}}</li>
    @endforeach
    </ul>
</div>
    @endif
@endsection