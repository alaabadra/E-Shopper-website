@extends('layout')

@section('title')
    All My Orders Page
@endsection

@section('content')
<style>
    body{
        margin:0;
        padding:0;
        background-color:#ffefef;
    }
    .header{
  margin-top: 43px;
    font-family: fantasy;
}
.header:hover{
  color:#ff00bc;
}
</style>
<?php
use App\OrdersProduct;
use App\Cart;
?>
<div class="header">
    
    <h1 style="       margin-left: 629px;
    margin-bottom: -24px;">Your Orders</h1>
    </div>
@if(empty($allMyOrders))
<div class="alert alert-info" role="alert">
  there is no orders for you , you can make an order from page details the product that you want it , but before this , you must add this product in cart
</div>
@else
@foreach($allMyOrders as $MyOrder)
<?php
        $order=OrdersProduct::where(['order_id'=>$MyOrder->id])->get();
        ?>
          @foreach($order as $ord)
          <?php
          $sessionEmail=Session::get('sessionUser');
        $productCart=  Cart::where(['product_id'=>$ord->product_id,'user_email'=>$sessionEmail])->get();
          ?>
          @endforeach
<div class="container">   

  <div class="row">

       
    <div class="card text-black border-primary mb-3" style="    max-width: 40rem;
    margin-left: 363px;
    margin-top: 57px;
    height: 225px;">
  <div class="card-header">
  <h3>order number:{{$MyOrder->id}}</h3>
  </div>
  <div class="card-body" style="padding-top: 31px;">
    <h5 class="card-title">grand Total:{{$MyOrder->grand_total}}</h5>
    <h5 class="card-title">coupon Code:{{$MyOrder->coupon_code}}</h5>
    <p class="card-text">coupon Mount:{{$MyOrder->coupon_amount}}</p>
  </div>
  <a href="{{url('/view-details-this-order/'.$MyOrder->id)}}" style=" margin-left: 223px;
    margin-bottom: -42px;" class="btn btn-info">View Details</a>
  <a class="btn btn-danger deleteRecorder" rel="{{$MyOrder->id}}" rel1="delete-order"  href="javascript:" style="width: 182px;">Delete Order</a>
  </div>          
   @endforeach
   @endif
</div><br><br>
<script>
$(".deleteRecorder").click(function(){
  var id=$(this).attr('rel');
  var deleteFun=$(this).attr('rel1');
  swal({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  type:"warning",
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  confirmButtonClass: 'btn-dange',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
},
  function(){
    window.location.href=deleteFun+"/"+id;
  });

});
</script>
@endsection