
@extends('layout')

@section('title')
    Category Page
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
<div class="widget-title"> <span><i class="icon-th"></i></span>
<div class="header">

                    <h1 style="     margin-left: 590px;
    margin-bottom: 73px;">Results  Your Search</h1>
</div>
<div class="row">
  @if($searchProdCount==0)
  <div class="alert alert-info" role="alert"style="margin-left: 202px;
    margin-top: 62px;">
   <h4>there is no results in your search on this product</h4> 
  </div>
  @endif
  @foreach($searchProd as $prod)
  <?php
                 $prodStatus= $prod->product_status;
                ?>
  <div class="col-md-3">

<a href="/view-details-product/{{$prod->id}}/{{$prod->category_id}}"style="    margin-left: 55px;
margin-bottom: 28px;margin-top:32px">{{$prod->product_name}}</a>
<div class="card"style="    width: 75%;
margin-left: 47px;
margin-bottom: 63px;">
@if(!empty($prod->product_image))
<img src="{{asset('/images/backend_images/products/small/'.$prod->product_image)}}" style="width: 284px;
margin-left: 1px;">

<div class="card-body">
@else
<img src="https://lh3.googleusercontent.com/proxy/pHOOPR3gEOodw8eUPwjxI6QPgaOgI_nfi0QHx04rwjd9CMInnbuF84heXiNDPlvBOY9J69ic12LmfC_DXZwRdB4N99ugpLZGtz189knY5xXfYIk-Bl74L_s" alt="">
@endif
<h5></h5>
    <h6>{{$prod->product_size}}</h6>
    @if($prodStatus==0)
      <a href="" class="btn btn-danger">Will Be Soon Come</a>
    @elseif($prodStatus==1)
    <a href="" class="btn btn-warning"> It  Will finish Soon</a>
    @elseif($prodStatus==2)
    <a href="" class="btn btn-success"> Exsit is Enough</a>
    @endif

</div>
</div>
</div>

  @endforeach
</div>

@endsection