
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
.header{
  margin-top: 43px;
    font-family: fantasy;
}
.header:hover{
  color:#ff00bc;
}
    </style>




        
<div class="header">
            
            <h1 style="    margin-top: -16px;
    margin-left: 564px;
    margin-bottom: 53px;">All Makeups Products</h1>
        </div>
        

            <!-- First row -->
  <div class="row">
            @foreach($prodsHighModern as $prod)
  
            <?php
                 $prodStatus= $prod->product_status;
                ?>
                <div class="col-md-3">

                        <a href="/view-details-product/{{$prod->id}}/{{$prod->category_id}}"style="    margin-left: 55px;
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