@extends('layout')
@section('content')

<section id="do-action">
    <div class="container">
        <div class="heading" align="center">
            <h3>YOUR CDO HAS BEEN CANCELLED</h3>
            <p>Please contact us if there is any enquiery</p>
            <p>Your order number is{{Session::get('sessionOrderId')}} and total amount paid is INR {{Session::get('sessionGrandTotal')}} </p>
        
        </div>
    </div>
</section>
@endsection