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
use App\ProductsAttribute;
        $product=ProductsAttribute::where(['id'=>$product_Attr_id])->first();

?>
<div class="header">

<h1 style="   margin-left: 462px;
    margin-bottom: 35px;
">All Reviews on <a href="/view-details-product-attr/{{$product_Attr_id}}">{{$product->product_name}}</a></h1>
</div>



@if($revsCount==0)
            <div class="alert alert-info" role="alert"style="    margin-left: 116px;
    width: 26%;">
<h4 >there is no review on this product until now </h4>
</div>
            @elseif($revsCount!==0)

@foreach($revs as $review)
                <?php
                 $rankReview= $review->rank_review;
                 ?>
                <div class="reviwe" style="    margin-left: 111px;">
                
                <div class="col-md-3">
                        
                    <div class="card">
                        <!-- <img src="img/show 1.jpg" alt="" srcset="" class="card-img-top"> -->
                        <div class="card-body">
              

                            <h4>{{$review->user_email}}</h4>
                            @if($rankReview==0|| $rankReview==1 ||$rankReview==2)
                              <a href="" class="btn btn-danger"style="margin-left: 97px;">low review</a>
                            @elseif($rankReview==3)
                            <a href="" class="btn btn-warning"style="margin-left: 97px;">meduim review</a>
                            @elseif($rankReview==4||$rankReview==5)
                            <a href="" class="btn btn-success"style="margin-left: 97px;">High review</a>
                            @endif
                           <h4>Review Description:{{$review->review_desc}}</h4> 
                   @if($review->user_email==Session::get('sessionUser'))
               
                   <a href="{{url('/edit-my-review/'.$review->id.'/'.$product_Attr_id)}}"><i class="	glyphicon glyphicon-pencil" style="    font-size: 15px;
                       color: black;
                       margin-left: 280px;"></i></a> 
                   <a class="deleteRecorder" style="margin-left: -62px;" rel="{{$review->id}}"rel1="delete-my-review"><i class="	glyphicon glyphicon-trash" style="    font-size: 15px;
                       color: red;
                       cursor: pointer;"></i></a> 
                   @endif
               

                        </div>
                    </div>
                </div>
           
                </div>
               @endforeach
               @endif
          
            </div>
<script>
$(".deleteRecorder").click(function(){
  var id=$(this).attr('rel');
  var deleteFun=$(this).attr('rel1');
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
</script>
@endsection
