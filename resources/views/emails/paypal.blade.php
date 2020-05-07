@extends('layout')
@section('content')


<section id="do-action">
    <div class="container">
        <div class="heading" align="center">
            
            <?php
            use App\Order;
            use App\User;
            $orderId=Session::get('sessionOrderId');
            //echo  $orderId;die;
            $orderDetails=Order::where(['id'=>$orderId])->first();
            $orderDetails=json_decode(json_encode($orderDetails));
            $userDetails=User::where(['email'=>$orderDetails->user_email])->first();
            $userDetails=json_decode(json_encode($userDetails));
          //  echo $userDetails;die;

          //  echo '<pre>';print_r($userDetails->name);die;
            $nameUser=$userDetails->name;
            // $getCountryUser=Order::where($userDetails->country)->first();
            ?>
    <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
        <input type="hidden" name="cmd" value="_xclick" id="">
        <input type="hidden" name="business" value="alaabadra4@gmail.com" id="">
        <input type="hidden" name="item_name" value="{{Session::get('sessionOrderId')}}" id="">
        <input type="hidden" name="currency_code" value="INR" id="">
        <input type="hidden" name="amount" value="{{Session::get('sessionGrandTotal')}}" id="">
        <input type="hidden" name="name" value="{{$nameUser}}" id="">
        <input type="hidden" name="email" value="{{$userDetails->email}}" id="">
        <input type="hidden" name="address" value="{{$userDetails->address}}" id="">
        <input type="hidden" name="city" value="{{$userDetails->city}}" id="">
        <input type="hidden" name="country" value="{{$userDetails->country}}" id="">
        <input type="hidden" name="state" value="{{$userDetails->state}}" id="">
        <input type="hidden" name="pincode" value="{{$userDetails->pincode}}" id="">
        <input type="hidden" name="return" value="{{url('/paypal/thanks')}}" id="">
        <input type="hidden" name="cancel_return" value="{{url('/paypal/cancel')}}" id="">
        <!-- <input type="hidden" name="notify_url" value="{{url('/paypal/ipn')}}" id=""> -->
        <input type="image"  src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/btn_paynow_107x26.png" alt="Pay Now" name="" id="">
        <img src="https://www.paypalobjects.com/webstatic/en_US/i/src/pixel.gif" width="1" height="1" alt="">
        

        <!-- <input type="text" name="no_note" value="1">
    <input type="text" name="currency_code" value="USD">
    <input type="text" name="lc" value="AU">
    <input type="text" name="bn" value="PP-BuyNowBF">
    <input type="image" src="https://www.paypal.com/en_AU/i/btn/btn_buynow_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online.">
    <img alt="" border="0" src="https://www.paypal.com/en_AU/i/scr/pixel.gif" width="1" height="1"> -->
    </form>

        </div>
    </div>
</section>
@endsection