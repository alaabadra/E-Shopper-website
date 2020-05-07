
@extends('layout')
@section('content')

    <style>
             body{
        margin:0;
        padding:0;
        background-color:#ffefef;
    }
      .card-title {
        font-weight: 300;
        font-size: 2rem;
    }
    .product-card .card {
        margin: 20px;
        overflow: hidden;
    }
    .product-card .card .card-content {
        padding: 5px;
    }
    .product-card .card .price {
        width: 70px;
        height: 70px;
        font-weight: 600;
        font-size: 1.45rem;
        line-height: 70px;
        margin: 10px;
        position: absolute;
        top: 0;
        letter-spacing: 0;
    }
    .product-card ul.card-action-buttons {
        margin: -18px 7px 0 0;
        text-align: right;
    }
    .product-card ul.card-action-buttons li {
        display: inline-block;
        padding-left: 7px;
    }
    .product {
        width: 20%;
        padding: 10px;
    }
    .product .card {
        margin: 0;
    }
    .product .card .card-content {
        padding: 5px 10px;
    }
    
    a {
  -webkit-transition: .25s all;
  transition: .25s all;
}

.card {
  overflow: hidden;
  box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
  -webkit-transition: .25s box-shadow;
  transition: .25s box-shadow;
}

.card:focus,
.card:hover {
  box-shadow: 0 5px 11px 0 rgba(0, 0, 0, 0.18), 0 4px 15px 0 rgba(0, 0, 0, 0.15);
}

.card-inverse .card-img-overlay {
  background-color: rgba(51, 51, 51, 0.85);
  border-color: rgba(51, 51, 51, 0.85);
}
    
    </style>
<?php
    use App\Review;
    use App\ProductsAttribute;
    $productN=ProductsAttribute::where(['id'=>$product_Attr_id])->first();
    // $productName=  $productN->product_name;
    ?>

    @if(empty($productN))
    <div class="alert alert-info" role="alert">
<h4 >there is no details for this product , because not exist  until now here </h4>
</div>
    @else
    <h1 style="     margin-left: 311px;
    margin-bottom: 75px;">View Details of {{$productN->product_name}}</h1>
    
  </div>


  <!-- First row -->
  <div class="row">
@foreach($product as $prod)
  <h6>iddd:{{$prod->id}}</h6>

        <?php
        $sessionEmailUser=Session::get('sessionUser');
        $reviewsOnThisProd=Review::where(['product_Attr_id'=>$prod->id])->get();
        $reviewsOnThisProdConutThisUser=Review::where(['product_Attr_id'=>$prod->id,'user_email'=>$sessionEmailUser])->count();
   
        ?>


<div class="container" style="">

  <div class="details-product" style="width: 100%;
    margin-top: -45px;
    margin-left: 42px;">
       
       <div class="col-md-4"style="">
               <h4 href="/view-details-product/{{$prod->id}}"style="  
 ">{{$prod->product_name}}</h4>
           <div class="card" style="width: 75%;
">
               <!-- <img src="img/show 1.jpg" alt="" srcset="" class="card-img-top"> -->
               @if(!empty($prod->product_image))
   <img  class="card-img-top img-responsive" src="{{asset('/images/backend_images/products/small/'.$prod->product_image)}}" style="width: 284px;
margin-left: 1px;">
   @endif

               <div class="card-body">
               @if(!empty($prod->product_image))
   @endif
               <h5></h5>
                   <div class="add-cart" style="         margin-left: 170px;
    
    margin-top: -5px;">

<a href="{{url('/add-to-cart/'.$prod->id)}}"><i class="fa fa-cart-arrow-down" aria-hidden="true" ></i></a>

<a href="{{url('/add-to-my-fav/'.$prod->id.'/'.$prod->product_name.'/'.$prod->product_size.'/'.$prod->product_price)}}"><i class="glyphicon glyphicon-heart"></i></a>
@if(empty($product_Attr_id))
<a href="{{url('/edit-my-review/'.$prod->id)}}"><i class="	glyphicon glyphicon-pencil" style="font-size:15px;color:black"></i></a> 
@else
<a href="{{url('/add-my-review/'.$prod->id)}}"><i class=" glyphicon glyphicon-star-empty"></i></a>
 @endif
</div>


 <h6 class="text-muted">product price : {{$prod->product_price}}</h6>
 <h6 class="text-muted">product color : {{$prod->product_color}}</h6>
 <h6 class="text-muted">product size :{{$prod->product_size}}</h6>
 <!-- <p class="card-text">product description :{{$prod->product_desc}}</p> -->
<div class="product_code" style="    margin-top: 19px;">

<h4>  product code  <?php echo DNS1D::getBarcodeHTML($prod->product_code, "C39");?>
</div>
</h4>
<!-- <div class="pincode" style="    margin-top: 29px;"> -->
<p><b>Delivery</b>
<input type="text" name="pincode" id="chkPincodeInput" placeholder="Check Pincode"style="    width: 124px;">
<button type="submit" onclick="return checkPincode();" class="btn btn-success" style=" margin-left: 181px;
    width: 13px;
    padding-right: 33px;
    margin-top: -45px;
    padding-left: 10px;;">Go</button>
<span id="pincodeResponse"></span>


</div>

<span id="pincodeResponse"></span>
<a href="{{url('/show-reviewers/'.$prod->id)}}"class="btn btn-info" style="     margin-left: 136px;
    margin-top: -1px;
    width: 108px;
    padding-left: 10px;
    padding-right: 10px;" >See Reviewers</a>



               </div>
           </div>
       </div>
<!-- </div> -->



    
 
               @endforeach
@endif
</div><br><br>


<script>


function checkPincode(){
 var pincode = $("#chkPincodeInput").val();
 $.ajax({
  type:'post',
  data:{pincode:pincode},
  url:'/check-pincode',
  success:function(resp){
    //   alert(resp);
   if(resp>0){
    $("#pincodeResponse").html("<font color='green'>This pincode is available for delivery</font>");
   }else{
    $("#pincodeResponse").html("<font color='red'>This pincode is not available for delivery</font>"); 
   }
  },error:function(){
   alert("Error");
  }
 });
}
  
</script>
@endsection