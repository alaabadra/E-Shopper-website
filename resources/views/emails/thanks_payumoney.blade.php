@extends('layout')
@section('content')

<section id="cart_item">
    <div class="container">
        <div class="breadcrumbs">
            <div class="breadcrumb">
                <ol class="breadcrumb">
                    <li><a href="">Home</a></li>
                    <li><a class="active" href="">Home</a></li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section id="do-action">
    <div class="container">
        <div class="heading" align="center">
            <h3>YOUR PAYUMONEY HAS BEEN PLACED</h3>
            <p>Thanks for the payment. we will process your order very soon</p>
            <p>Your order number is{{Session::get('sessionOrder_id')}} and total amount paid is INR {{Session::get('sessionGrandTotal')}} </p>
        </div>
    </div>
</section>
@endsection