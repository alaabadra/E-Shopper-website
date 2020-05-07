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
  .header{
  margin-top: 43px;
    font-family: fantasy;
}
.header:hover{
  color:#ff00bc;
}
</style>
<div class="header">

<h1 style="    margin-left: 631px;
    margin-bottom: 53px;
    margin-top: 41px;"> Add To Your Order</h1>
</div>

<form action="{{url('/add-to-my-orders/'.$productId)}}" method="post"style="    margin-top: 25px;
    margin-left: 122px;">
<div class="form-group">{{csrf_field()}}
    <label for="coupon_code" class="form-label">coupon Code</label>
    <input type="text" class="form-control" id="coupon_code" placeholder="coupon_code" name="coupon_code"  value="{{$couponCodeThisUser}}">
  </div>
  <div class="form-group">
    <label class="form-label">enable</label>
    <div class="controls">
    
    <input type="checkbox"  name="status" style="margin-left:500px" > 
    </div>
  <button type="submit" class="btn btn-primary"style=" margin-left: 492px;
    width: 24%;">Add</button>
</form>
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
@endsection