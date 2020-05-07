@extends('layout')
@section('title')
    VIEW BANNERS Page
@endsection
@section('content')

    <div class="container">
        <div class="row">
        <div class="card text-black border-primary mb-3" style="    max-width: 40rem;
    margin-left: 363px;
    margin-top: 57px;
    height: 225px;">


    <div class="card-header">
  <h3>cart id : {{$cart->id}}</h3>
  </div>
  <div class="card-body">
    <h5 class="card-title">product size:{{$cart->product_size}}</h5>
    <p class="card-text">product price:{{$cart->product_price}}</p>
    <p class="card-text">product code:{{$cart->product_code}}<?php echo DNS2D::getBarcodeHTML($cart->product_code, "C39");?></p>
    <p>product color:{{$cart->product_color}}</p>
    <p>product status:{{$cart->product_status}}</p>

    
  </div>
    </div>
        </div>
    </div>
@endsection