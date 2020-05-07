@extends('layout')


@section('content')
<?php
use App\Order;
$myOrdersCount=Order::where(['user_email'=>Session::get('sessionUser')])->count();
?>
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
<div class="header">
    
    <h1 style="     margin-left: 629px;
    margin-bottom: 19px;">Your Profile</h1>
    </div>

<div class="container emp-profile" >
                <div class="row">
           
                    <div class="col-md-4">
                        <div class="profile-img" style=" width: 181px;
    margin-top: 15px;
    margin-left: 69px;">
                        @if(empty($imageUser))
                        <img src="https://getdrawings.com/free-icon/default-avatar-icon-65.png" alt="Avatar" class="avatar"style="     width: 71%;
    margin-left: 21px;">
                        @else
            <img  class="card-img-top img-responsive" src="{{asset('/images/backend_images/products/small/'.$dataThisUser->image)}}" style="width:488px;">
            @endif
                            <div class="file btn btn-lg btn-primary" style="    margin-top: 33px;
    margin-left: 11px;">
                                
                              <a href="{{url('/change-image/'.$dataThisUser->id)}}" class="btn btn-info">Change Photo</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head" style="    margin-bottom: 58px;">
                                    <h5 >Name:
                                    <span style=" font-family: fantasy;">
                                    {{$dataThisUser->name}}
                                    </span>
                                    </h5>
                                    <h6>
                                    Email:{{$dataThisUser->email}}
                                    </h6>
                                    <p class="proile-rating">RANKINGS : <span>8/10</span></p>
                            <ul class="nav nav-tabs" id="myTab" role="tablist" style="    margin-top: 56px;">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Timeline</a>
                                </li>
                            </ul>
                            <h3>city:  {{$dataThisUser->city}}</h3>
                            <h3>country_name:  {{$dataThisUser->country_name}}</h3>
                            <h5>Date Joined :{{$dataThisUser->created_at}}</h5>
                            <h5>Last time modified your profile :{{$dataThisUser->updated_at}}</h5>
                          
                        </div>
                        <div class="buttons" style="margin-left: 162px;">
                        
                        <a href="{{url('/checkout-shipping/'.$dataThisUser->id)}}" class="btn btn-success">checkout for delivery</a>
                            <a href="{{url('/checkout-billing/'.$dataThisUser->id)}}" class="btn btn-success">checkout for billing</a>
                            <a href="{{url('/view-all-my-orders-review')}}" class="btn btn-info" style="    margin-left: -503px;"><span style="color:red">{{$myOrdersCount}}</span> view all my orders review</a>
                        </div>
                    </div>
                    <div class="col-md-2">
                    <a href="{{url('/edit-profile/'.$dataThisUser->id)}}"  class="btn btn-info">Eit My profile</a>

                    </div>
                </div>
              
                 
                </div>
        </div>
@endsection
