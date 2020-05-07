
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

<h1 style="margin-left: 656px;"> Add Your Copoun</h1>
</div>

<div class="from">

  <form action="{{url('/add-coupon')}}" method="post" enctype="multipart/form-data" style="    margin-top: 25px;
    margin-left: 122px;">
  {{csrf_field()}}
  

    <div class="form-group">
      <label for="coupon_code" class="form-label" >Coupon Code</label>
      <input type="text" class="form-control" id="coupon_code" placeholder="coupon_code" name="coupon_code">
    </div>
    <div class="form-group">
      <label for="amount"class="form-label">Mount</label>
      <input type="number"  class="form-control" id="amount" placeholder="amount"name="amount"  min="0"autocomplete="off">
    </div>
  
    <div class="form-group">
      <label for="amount_type"class="form-label">Mount Type</label>
      <select name="amount_type" id=""class="form-control">
      <option value="amount_type" disabled>Mount Type</option>
      <option value="fixed">fixed</option>
      <option value="percentage">percentage</option>
      </select>
    </div>
  
    <div class="form-group">
      <label for="expiry_date"class="form-label">Expiry Date</label>
      <input type="text" class="form-control" id="expiry_date" placeholder="expiry_date" name="expiry_date" autocomplete="off">
    </div>
  
    <div class="form-group">
      <label class="control-label" class="form-label" style="margin-left: 494px;">enable</label>
      <div class="controls">
      
      <input type="checkbox"  name="status"style="margin-left:506px"  > 
      </div>
  
  
  
  
    <button type="submit" class="btn btn-primary"class="form-label"style=" margin-left: 492px;
    width: 24%;">Add</button>
  </form>
</div>
@endsection