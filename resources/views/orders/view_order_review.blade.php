

@extends('layout')

@section('title')
    Order Page
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
use App\Cart;

?>
<div class="header">

    <h1 style="    margin-left: 544px;">View Details Your Order</h1>
</div>
<div class="container">   

<div class="row">

     
  <div class="card text-black border-primary mb-3" style="    margin-left: 363px;
    width: 333px;
    margin-top: 57px;
    height: 305px;">
<div class="card-header">
<h3 style="    margin-left: 39px;">Billing</h3>
</div>
<div class="card-body"style="padding-left: 55px;">
  <h5 class="card-title">Bill Address:{{$billingUser->email}}</h5>
  <h5 class="card-title">Name:{{$billingUser->name}}</h5>
  <p class="card-text">address:{{$billingUser->address}}</p>
  <p class="card-text">city:{{$billingUser->city}}</p>
  <p class="card-text">country:{{$billingUser->country}}</p>
  <p class="card-text">mobile:{{$billingUser->mobile}}</p>
  <p class="card-text">pincode:{{$billingUser->pincode}}</p>
  
</div>
</div><br><br>

<div class="container" >

<div class="row">

     
  <div class="card text-black border-primary mb-3" style="    margin-left: 363px;
    width: 333px;
    margin-top: 57px;
    height: 305px;">
<div class="card-header">
<h3 style="    margin-left: 39px;"> Shipping Address</h3>
</div>
<div class="card-body"style="padding-left: 55px;">
  <h5 class="card-title">shipping Address:{{$shippingUser->email}}</h5>
  <h5 class="card-title">Name:{{$shippingUser->name}}</h5>
  <p class="card-text">address:{{$shippingUser->address}}</p>
  <p class="card-text">city:{{$shippingUser->city}}</p>
  <p class="card-text">country:{{$shippingUser->country}}</p>
  <p class="card-text">mobile:{{$shippingUser->mobile}}</p>
  <p class="card-text">pincode:{{$shippingUser->pincode}}</p>
  
</div>
</div><br><br>
</div>
                  <h3 style="    margin-left: 287px;   font-family: fantasy;">All products for this user in this order only</h3>



                  <?php $total_mount=0; ?>
           
                  @foreach($order as $ord)
         <?php 
        $sessionEmail=Session::get('sessionUser');
        $productCart=  Cart::where(['product_id'=>$ord->product_id,'user_email'=>$sessionEmail])->get();
        ?>
        @foreach($productCart as $prod)
<div class="container">
        <div class="row">
  <div class="card text-black border-primary mb-3" style="    max-width: 40rem;
  margin-left: 363px;
  margin-top: 57px;
  height: 225px;">
<div class="card-header">
product_name:{{$prod->product_name}}
</div>
<div class="card-body">
  <h5 class="card-title">productCode:{{$prod->product_code}}</h5>
  <p class="card-text">product Quantity:{{$prod->product_quantity}}</p>
  <p class="card-text">product Price:{{$prod->product_price}}</p>

  
  <p class="card-text">total Mount:{{$total_mount=($prod->product_price*$prod->product_quantity)}}</p>
</div>
</div><br><br>
</div>
@endforeach
            @endforeach

           
                  <div class="container">
                  
                    <tr>
                        <td colspan="4">
                        <td colaspn="2">
                            <table class="table table-condensed total-result">
                            <tr>
                                    <td>cart sub total</td>
                                    <td>INR {{$total_mount}}</td>
                                </tr>
                                <tr class="shipping-cost">
                                    <td>shipping-cost(+)</td>
                                    <td>INR 0</td>
                                </tr>
                                <tr>
                                    <td>coupon discount(-)</td>
                                    <td>INR : from {{Session::get('sessionCouponMount')}}</td>
                                </tr>

                                <tr>
                                    <td>grand total</td>
                                    <td><span>{{$total_mount}} - {{Session::get('sessionCouponMount')}}</span></td>

                                    <td><span>{{$grand_total=$total_mount - Session::get('sessionCouponMount')}}</span></td>   
                                </tr>
                            </table>
                        </td>
                        </td>
                    </tr>
                  </div>

            </div>
            </div>
            <div>
     
            </div>

            <div class="Container">
            
            <div class="row">
              <div class="col-sm-6">
                <div class="chose_area">
                    <li>
                    
                        <form action="{{url('/apply-coupon')}}" method="post">
                        {{csrf_field()}}
                        </form>
                      </div>
                      <form action="{{url('/place-order')}}" name="paymentForm" id="paymentForm" method="post">
                      {{csrf_field()}}
                      <div class="payment-options" style="margin-top: -34px;">
                          <span>
                              <label for=""><strong>select payment method:</strong></label>
                          </span>
                          <span>
                              <label for=""><input type="radio" name="payment_method" id="COD" value="COD">COD</label>
                          </span>
                          
                          <span>
                              <label for=""><input type="radio"name="payment_method" id="Paypal" value="Paypal"> paypal</label>
                          </span>
                          <span>
                              <label for=""><input type="radio"name="payment_method" id="Payumoney" value="Payumoney"> Payumoney</label>
                          </span>
                          <span style="float:right">
                          <button type="submit" id="Paypal" class="btn btn-success" onclick="return selectPaymentMethod()" > place order</button>
                          </span>
                      </div>

                      </form>
                    </li>
                </div>
              </div>
            </div>
            

        
    </div>
@endsection

