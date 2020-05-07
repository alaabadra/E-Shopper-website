@extends('layout')
@section('title')
    VIEW MY CART Page
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
<div class="header">
    
    <h1 style="       margin-left: 629px;
    margin-bottom: -24px;">Your Cart</h1>
    </div>

    @if(empty($allMyCarts))
        <div class="alert alert-info" role="alert" style="    margin-bottom: 49px;
    margin-top: 80px;
    margin-left: 102px;
    width: 30%;
">
        there is no products in cart, to add it you can add to cart a product
</div>
    @else
    @foreach($allMyCarts as $mycart)

<div class="container">    
  <div class="row">

       
    <div class="card text-black border-primary mb-3" style="    max-width: 40rem;
    margin-left: 363px;
    margin-top: 57px;
    height: 225px;">
  <div class="card-header">
  <h3>{{$mycart->product_name}}</h3>
  </div>
  <div class="card-body">
    <h5 class="card-title">product price:{{$mycart->product_price}}</h5>
    <p class="card-text"> description:{{$mycart->review_desc}}</p>
    <p class="card-text">product code:{{$mycart->product_code}}<?php echo DNS2D::getBarcodeHTML($mycart->product_code, "C39");?></p>
    
  </div>
  <!-- <div class="card-footer"> -->
  <div class="danger" style=" margin-right: 227px;
    margin-bottom: -34px;
    margin-left: -1px;">
  
  <!-- <a class="btn btn-danger" href="{{url('/delete-product-from-cart/'.$mycart->product_id)}}" >Delete Product</a> -->
  <a class="btn btn-danger deleteRecorder" rel="{{$mycart->product_id}}" rel1="delete-product-from-cart"  href="javascript:" >Delete Product</a>
  </div>
  <div class="success" style="margin-left: 237px;
    margin-bottom: -1px;">
  
        <a class="btn btn-success" href="{{url('/add-to-my-orders/'.$mycart->product_id)}}">ِAdd to my orders</a>
  </div>
  <!-- </div> -->
</div>
   @endforeach
   @endif
</div><br><br>

<script>
$(".deleteRecorder").click(function(){
  var id=$(this).attr('rel');
  var deleteFun=$(this).attr('rel1');
  //alert(deleteFun);
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



// $('deleteRecorder').click(function(e){
//   var id=$(this).attr('rel');
//   alert(id);
//   return false;
 
// })
</script>
@endsection