@extends('layout')
@section('title')
    VIEW BANNERS Page
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

            <div class="container mt-5">
            <div class="row">
            <div class="header">
            
                <h1 style="    margin-top: -46px;
    margin-left: 498px;
    margin-bottom: 35px;">All bags</h1>
            </div>
            </div>
           
        </div>
        <?php
        use App\Product;
            $prodsBags=Product::where(['type'=>'bags'])->get();

  ?>
            <div class="row">
            @foreach($prodsBags as $prod)

            <?php
                 $prodStatus= $prod->product_status;
                ?>
                <div class="col-md-3">

                        <a href="/view-details-product/{{$prod->id}}"style="    margin-left: 55px;
    margin-bottom: 28px;margin-top:32px">{{$prod->product_name}}</a>
                    <div class="card"style="    width: 75%;
    margin-left: 47px;
    margin-bottom: 63px;">
                        @if(!empty($prod->product_image))
            <img src="{{asset('/images/backend_images/products/small/'.$prod->product_image)}}" style="width: 284px;
margin-left: 1px;">
                        @else
            <img src="https://lh3.googleusercontent.com/proxy/pHOOPR3gEOodw8eUPwjxI6QPgaOgI_nfi0QHx04rwjd9CMInnbuF84heXiNDPlvBOY9J69ic12LmfC_DXZwRdB4N99ugpLZGtz189knY5xXfYIk-Bl74L_s" alt="">
            @endif
                        <div class="card-body">
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

        </div>

@endsection