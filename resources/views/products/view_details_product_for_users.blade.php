
@extends('layout')

@section('title')
    Category Page
@endsection

@section('content')

      <script>
      function getMessage() {
            $.ajax({
               type:'POST',
               url:'/getmsg',
               data:'_token = <?php echo csrf_token() ?>',
               success:function(data) {
                  $("#msg").html(data.msg);
               }
            });
         }
      </script>
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
.header{
  margin-top: 43px;
    font-family: fantasy;
}
.header:hover{
  color:#ff00bc;
}
    
    </style>
<?php
    use App\Review;
    use App\ProductsAttribute;
    $productN=ProductsAttribute::where(['product_id'=>$product_id])->first();
    ?>

    <div class="header">
    
    <h1 style="      margin-left: 397px;
    margin-bottom: 75px;">All Available Units Of << {{$productN->product_name}} >></h1>
    </div>
    @if(empty($productN))
    <div class="alert alert-info" role="alert"style="    margin-left: 66px;
    width: 361px;">
<h4 >there is no details for this product , because not exist  until now here </h4>
</div>
    @else

    <h5 style="    margin-left: 259px;
    margin-bottom: 58px;">FILTERS</h5>
   

<div class="left-sidebar"style="     margin-left: 28px;
    width: 7%;">
    <div style="    margin-bottom: 37px;">
    <form action="{{url('/products-filter-view-details')}}" method="post">{{csrf_field()}}
@if(!empty($productName))
      <input type="hidden" name="id"  id="" value="{{$productName->product_id}}">
      <input type="hidden" name="url"  id="" value="{{$productName->product_name}}">
    @else
    <div class="alert alert-info" role="alert">
  <h4>this product still not come , will come soon</h4>  
    </div>
    @endif
    <div class="panel-group category-products">
    

        @foreach($colors as $color)
    @if(!empty($_GET['color']))
      <?php
        $colorArr=explode('-',$_GET['color']);
        ?>
    @endif
      <div class="panel panel-default">
      
      <div class="panel-heading">
    
        <h4 class="panel-title">
        
          <input name="colorFilter[]" id="{{$color->product_color}}" onchange='javascript:this.form.submit();'value='{{$color->product_color}}' type="checkbox"@if(!empty($colorArr)&&in_array($color->product_color,$colorArr)) checked="" @endif>&nbsp;&nbsp; <span class="category-colors" > {{$color->product_color}}</span>
         
        </h4>  
      </div>
      </div>
          @endforeach
      </div>

    </form>
    </div>
    <div class="size"style="margin-top: -1161px;
    margin-left: 202px;">
    <form action="{{url('/products-filter-size-view-details')}}" method="post"style="width: 114px;
    /* margin-top: -5px; */
    margin-bottom: 33px;">{{csrf_field()}}
@if(!empty($productName))
      <input type="hidden" name="id"  id="" value="{{$productName->product_id}}">
      <input type="hidden" name="url"  id="" value="{{$productName->product_name}}">
    @else
    <div class="alert alert-info" role="alert">
  <h4>this product still not come , will come soon</h4>  
    </div>
    @endif
    <div class="panel-group category-products"style="  margin-top: 542px;">
    

        @foreach($sizes as $size)
        @if(!empty($_GET['size']))
      <?php
        $sizeArr=explode('-',$_GET['size']);
      ?>
    @endif
      <div class="panel panel-default">
      
      <div class="panel-heading">
    
        <h4 class="panel-title">
        
          <input name="sizeFilter[]" id="{{$size->product_size}}" onchange='javascript:this.form.submit();'value='{{$size->product_size}}' type="checkbox"@if(!empty($sizeArr)&&in_array($size->product_size,$sizeArr)) checked="" @endif>&nbsp;&nbsp; <span > {{$size->product_size}}</span>
         
        </h4>  
      </div>
      </div>
          @endforeach
      </div>

    </form>
    </div>

  <div class="price" style="    margin-top: -2225px;
    margin-left: 397px;">
    <form action="{{url('/products-filter-price-view-details')}}" method="post"style="width: 117px;">{{csrf_field()}}
@if(!empty($productName))
      <input type="hidden" name="id"  id="" value="{{$productName->product_id}}">
      <input type="hidden" name="url"  id="" value="{{$productName->product_name}}">
    @else
    <div class="alert alert-info" role="alert">
  <h4>this product still not come , will come soon</h4>  
    </div>
    @endif
    <div class="panel-group category-products" style="      margin-top: 868px;">
    

        @foreach($prices as $price)
        @if(!empty($_GET['price']))
      <?php
        $priceArr=explode('-',$_GET['price']);
      ?>
    @endif
      <div class="panel panel-default">
      
      <div class="panel-heading">
    
        <h4 class="panel-title">
        
        <input name="priceFilter[]" id="{{$price->product_price}}" onchange='javascript:this.form.submit();'value='{{$price->product_price}}' type="checkbox"@if(!empty($priceArr)&&in_array($price->product_price,$priceArr)) checked="" @endif>&nbsp;&nbsp; <span > {{$price->product_price}}</span>

         
        </h4>  
      </div>
      </div>
          @endforeach
      </div>

    </form>
  </div>
  </div>


  <!-- First row -->
  <div class="row">
@foreach($product as $prod)

        <?php
        $sessionEmailUser=Session::get('sessionUser');
        $reviewsOnThisProd=Review::where(['product_Attr_id'=>$prod->id])->get();
        $reviewsOnThisProdConutThisUser=Review::where(['product_Attr_id'=>$prod->id,'user_email'=>$sessionEmailUser])->count();
   
        ?>


<div class="container" style="width: 956px;
    margin-top: -1318px;
    margin-right: 28px;">
    @if($mainCategoryCount!==0)
<div align="left" style=" margin-left: -491px;
    margin-bottom: 40px;
    margin-top: -54px;">
  <?php echo $breadcrumb?>
</div>
@endif
  <div class="details-product" style="width:100%;">
  <div class="input-group" style="">
      <div class="input-group-btn" style="margin-top: 5px;">
      <input type="text" class="form-control" size="50" placeholder="Check Pincode" required style="  width: 58%;
    margin-left: 95px;
    height: 33px;" id="chkPincodeInput" name="pincode">
        <button type="submit" onclick="return checkPincode();" class="btn btn-info" style="margin-left: 0px;">Check Pincode</button>
      </div>
    </div>
<span id="pincodeResponse" style="color:#ffefef">This pincode is not available for deliveryss</span>
 
       <div class="col-md-4"style="">
               <h4 href="/view-details-product/{{$prod->id}}"style="  
    margin-bottom: 28px;margin-top:32px">{{$prod->product_name}}</h4>
           <div class="card" style="width: 75%;
">
               @if(!empty($prod->product_image))
   <img  class="card-img-top img-responsive" src="{{asset('/images/backend_images/products/small/'.$prod->product_image)}}" style="width: 284px;
margin-left: 1px;    object-fit: cover;">
   @endif

               <div class="card-body">
               @if(!empty($prod->product_image))
   @endif
               <h5></h5>
                   <div class="add-cart" style="        margin-left: 129px;!important;
margin-top: -5px;">

<a href="{{url('/add-to-cart/'.$prod->id)}}"><i class="fa fa-cart-arrow-down" aria-hidden="true" ></i></a>

<a href="{{url('/add-to-my-fav/'.$prod->id.'/'.$prod->product_name.'/'.$prod->product_size.'/'.$prod->product_price)}}"><i class="glyphicon glyphicon-heart"></i></a>
@if(!empty($product_Attr_id))
<a href="{{url('/edit-my-review/'.$prod->id)}}"><i class="material-icons" style="font-size:15px;color:black">border_color</i></a> 
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



</div>

<a href="{{url('/show-reviewers/'.$prod->id)}}"class="btn btn-info" style="margin-left: 99px;
    margin-top: -21px;
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
 if(pincode==""){
  alert("Please enter Pincode"); return false; 
 }
//  alert(pincode);return false;
 $.ajax({

  type:'post',
  data:{pincode:pincode},
  url:'/check-pincode',
  success:function(resp){
    //   alert(resp);
   if(resp=='exist'){
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