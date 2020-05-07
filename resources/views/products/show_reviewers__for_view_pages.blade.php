@extends('layout')
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
    use App\Review;
    use App\Product;
    $product=Product::where(['id'=>$product_id])->get();
    foreach($product as $prod){

        $reviewsOnThisProd=Review::where(['product_id'=>$prod->id])->get();
        echo $reviewsOnThisProd;die;
        $reviewsOnThisProdCount=Review::where(['product_id'=>$prod->id])->count();
    }

?>
<div class="header">

<h1>All Reviews on this product</h1>
</div>
@if($reviewsOnThisProdCount==0)
            <div class="alert alert-info" role="alert">
<h4 >there is no review on this product until now </h4>
</div>
@else
  @foreach($reviewsOnThisProd as $review)
                <?php
                 $rankReview= $review->rank_review;
                ?>
                <div class="col-md-3">
                        <a href="/view-details-product/{{$prod->id}}">{{$prod->product_name}}</a>
                    <div class="card">
                        <!-- <img src="img/show 1.jpg" alt="" srcset="" class="card-img-top"> -->
            <img src="{{asset('/images/backend_images/products/small/'.$prod->product_image)}}" >
                        <div class="card-body">
              

                            <h6>User Email:{{$review->user_email}}</h6>
                            @if($rankReview==0&& $rankReview==1 &&$rankReview==2)
                              <a href="" class="btn btn-danger">low review</a>
                            @elseif($rankReview==3)
                            <a href="" class="btn btn-warning">meduim review</a>
                            @elseif($rankReview==4&&$rankReview==5)
                            <a href="" class="btn btn-success">High review</a>
                            @endif
                           <h4>Review_desc:{{$review->review_desc}}</h4> 
                        </div>
                    </div>
                </div>
           
  @endforeach
@endif
          
            </div>
@endsection
