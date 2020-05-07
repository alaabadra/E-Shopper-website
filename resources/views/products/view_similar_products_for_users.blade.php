
@extends('layout')


@section('content')

<style>
       body{
        margin:0;
        padding:0;
        background-color:#ffefef;
    }
.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: 40%;
}

.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

.container {
  padding: 2px 16px;
}
</style>
<h1>All   similar products for  this product </h1>



@foreach($similarproducts as $product)

<?php
                 $prodStatus= $prod->product_status;
                ?>
                <div class="col-md-3">

                        <a href="/view-details-product/{{$prod->id}}"style="    margin-left: 55px;
    margin-bottom: 28px;margin-top:32px">{{$prod->product_name}}</a>
                    <div class="card"style="    width: 75%;
    margin-left: 47px;
    margin-bottom: 63px;">

                        <!-- <img src="img/show 1.jpg" alt="" srcset="" class="card-img-top"> -->
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
</div><br><br>

@endsection