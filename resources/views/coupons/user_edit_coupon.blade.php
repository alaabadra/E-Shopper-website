@extends('layout')

@section('title')
    user edit coupon Page
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
  .header{
  margin-top: 43px;
    font-family: fantasy;
}
.header:hover{
  color:#ff00bc;
}
</style>
<div class="header">

<h1 style=" margin-left: 656px;"> EDIT  COUPON</h1>
</div>

<form action="{{url('/user/edit-coupon/'.$editCoupon->id)}}" method="post"style="     margin-top: 66px;
    margin-left: 122px;">
{{csrf_field()}}

  <div class="form-group">
  <label for="coupon_code" class="form-label">Coupon Code</label>

  <input type="text" name="coupon_code"value="{{$editCoupon->coupon_code}}"class="form-control">
  </div>
  <div class="form-group">
    <label for="amount"class="form-label">Mount</label>
    <input type="amount" class="form-control" id="amount" placeholder="amount" name="amount"value="{{$editCoupon->amount}}">
  </div>


  <div class="form-group">
    <label for="amount_type"class="form-label">Mount Type</label>
    <select name="amount_type" id=""class="form-control">
    <option value="amount_type" disabled>Mount Type</option>
    @if($editCoupon->amount_type=="fixed")
    <option value="fixed" selected>fixed</option>
    <option value="percentage">percentage</option>
    @elseif($editCoupon->amount_type=="percentage")
    <option value="fixed" >fixed</option>
    <option value="percentage"selected>percentage</option>
    @endif
    </select>
  </div>

  <div class="form-group">
    <label for="expiry_date"class="form-label">Expiry Date</label>
    <input type="expiry_date" class="form-control" id="expiry_date" placeholder="expiry_date" name="expiry_date"value="{{$editCoupon->expiry_date}}">
  </div>



  <button type="submit" class="btn btn-primary"style=" margin-left: 492px;
    width: 24%;">EDIT</button>
</form>
@if($errors->any())
    @foreach($errors->all() as $error)
      <li>{{$error}}</li>
    @endforeach
    </ul>
</div>
    @endif
@endsection