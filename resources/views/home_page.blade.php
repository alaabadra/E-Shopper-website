

@extends('layout')

@section('title')
    Home Page
@endsection

@section('content')
<style>
    body{
        margin:0;
        padding:0;
        background-color:#ffefef;
    }
    .btn_successs{
        margin-left: 945px;
    margin-top: 24px;
    }
    .btn_success{
        margin-left:70px
    }
</style>
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel" style="    margin-top: -21px;">
          <?php
          use App\Banner;
        $banners=Banner::get();

          ?>
        <div class="carousel-inner">
          <div class="carousel-item active">
          <img  class="d-block w-100"  src="{{asset('/images/frontend_images/banners/'.$banners[0]->banner_image)}}" style="width:250px;">
            
            <div class="carousel-caption d-none d-md-block">
              <p style="    margin-top: 51px;
    /* padding-top: 15px; */
    color: black;">YOU ARE WELCOME IN OUR WEBSITE  , you can search on  products from here OR search on a specific product</p>
              </div>
          </div>
          @foreach($banners as $banner)
          @if($banner->banner_status==1)
          <div class="carousel-item ">
            <img class="d-block w-100"  src="{{asset('/images/frontend_images/banners/'.$banner->banner_image)}}" style="width:250px;">
            <div class="carousel-caption d-none d-md-block">
              <p style="    margin-top: 51px;
    /* padding-top: 15px; */
    color: black;">YOU ARE WELCOME IN OUR WEBSITE , you can search on  products from here OR search on a specific product</p>
              </div>

          </div>
         @endif
          @endforeach
            
          
          <form action="{{url('/search-products')}}" method="post"style="margin-left: -304px;">
{{csrf_field()}}
    <div class="input-group" style=" margin-top: 175px;
    margin-left: 537px;
    position: relative;
    width: 477px;
    display: table;
    border-collapse: separate;">
      <div class="form-group">
    <select name="product_name" id="" class="form-control" style="height: 41px;">
        <option>makeup</option>
        <option>t-shirt</option>
        <option>bags</option>
        <option>shoes</option>
        <option>dress</option>
     

 
    </select>
  </div>
      <div class="input-group-btn">
        <button type="submit" class="btn btn-danger" style="margin-left: 0px;
    margin-top: -1px;">Seacrh</button>
      </div>
    </div>
  </form>
  <form action="{{url('/search-product')}}" method="post" style="margin-left: 244px;">
{{csrf_field()}}
    <div class="input-group" style="     margin-top: -73px;
    margin-left: 537px;
    position: relative;
    width: 345px;
    display: table;
    border-collapse: separate;">
        <input type="text" name="product_name" class="form-control" id="inputPassword2" placeholder="Enter Your product"style="    height: 40px;">
                        &nbsp; &nbsp;

    </div>
      <div class="input-group-btn">
        <button type="submit" class="btn btn-danger" style="    margin-left: 881px;
    margin-top: -148px;">Seacrh</button>
      </div>
    </div>
  </form>

  
        </div>
        <div class="container-fluid offer pt-3 pb-3 bg-orange d-none d-md-block">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 m-right">
                        <h4>free shipping</h4>
                        <p>on order over 90$</p>
                    </div>
                    <div class="col-md-4 m-right">
                        <h4>CALL US AYTIME</h4>
                        <p>+91 73 554 55 11</p>
                    </div>
                    <div class="col-md-4">
                        <h4>OUR LOCATION</h4>
                        <p>hyderabad, palestine</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid bg-light-gray pt-5 pb-5">
    <?php 
      use App\Product;
      use App\Category;
      use App\ProductsAttribute;

      $modernProds=Product::get();
        $prods=Product::get();
      ?>
    <div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel"  data-interval="1000">
        </div>
    </div>

</div>

            <?php
            $getMainCats=Category::where(['parent_id'=>0])->get();
            $prodsTshirt=Product::where(['type'=>'t-shirt'])->limit(4)->get();
            $prodsTshirtCount=Product::where(['type'=>'t-shirt'])->limit(4)->count();
            $prodsShoesHeel=Product::where(['type'=>'shoes','type_shoes'=>'heel'])->limit(4)->get();
            $prodsMakeups=Product::where(['type'=>'makeup'])->limit(4)->get();
            $prodsMakeupsCount=Product::where(['type'=>'makeup'])->limit(4)->count();
            $prodsShoesHeelCount=Product::where(['type'=>'shoes','type_shoes'=>'heel'])->limit(4)->count();
            $prodsShoes=Product::where(['type'=>'shoes',])->limit(4)->get();
            $prodsShoesCount=Product::where(['type'=>'shoes'])->limit(4)->count();
            $prodsDress=Product::where(['type'=>'dress'])->limit(4)->get();
            $prodsDressCount=Product::where(['type'=>'dress'])->limit(4)->count();
            $prodsBags=Product::where(['type'=>'bags'])->limit(4)->get();
            $prodsBagsCount=Product::where(['type'=>'bags'])->limit(4)->count();
            $prodsWanted=ProductsAttribute::where('product_quantity','>',5)->limit(3)->get();
            $prodsWantedCount=ProductsAttribute::where('product_quantity','>',3)->limit(3)->count();
            $prodsHighPrice=ProductsAttribute::where('product_price','>',8)->limit(3)->get();
            $prodsHighPriceCount=ProductsAttribute::where('product_price','>',8)->limit(3)->count();
            $prodsHighFeature=Product::where('feature','>',4)->limit(3)->get();
            $prodsHighFeatureCount=Product::where('feature','>',4)->limit(3)->count();
            $prodsHighModern=Product::where('created_at','>',"2020-03-28")->limit(4)->get();
            $prodsHighModernCount=Product::where('created_at','>',"2020-03-28")->limit(4)->count();
            ?>
        <!-- حسب الستيتس -->
        <div class="container-fluid bg-light-gray">
            <div class="row">
                <h3>ALL FASHON TOP</h3>
            </div>
            <div class="underline"></div>
           
        </div>
            <div class="container mt-5">
            <div class="row">
                <h3>HIGH HEEL T-SHIRT</h3>
            </div>
            <div class="row">
                <div class="underline"></div>
            </div>
        </div>
        <div class="container mt-5 pb-5">
            <div class="row">
            @if($prodsTshirtCount==0)
            <div class="alert alert-info" role="alert">
<h4>there is no items until now here </h4>
</div>
            @else
            @foreach($prodsTshirt as $prod)

                <div class="col-md-3">
                    <div class="card">
                    @if(!empty($prod->product_image))
            <img src="{{asset('/images/backend_images/products/small/'.$prod->product_image)}}" style="width:250px;">
            @else
            <img src="https://lh3.googleusercontent.com/proxy/pHOOPR3gEOodw8eUPwjxI6QPgaOgI_nfi0QHx04rwjd9CMInnbuF84heXiNDPlvBOY9J69ic12LmfC_DXZwRdB4N99ugpLZGtz189knY5xXfYIk-Bl74L_s" alt="">
            @endif
                        <div class="card-body">
                        <h5>{{$prod->product_name}}</h5>
                            <h6>{{$prod->product_size}}</h6>
                            <a href="/view-details-product/{{$prod->id}}">view Details</a> 

                        </div>
                    </div>
                </div>
                
                @endforeach
            <div class="btn_successs">

                <a href="/view-all-high-tshirt" class="btn btn-success">Show More</a>
            </div>
        </div>
                @endif
              
            </div>

        <div class="container mt-5">
            <div class="row">
                <h3>HIGH  MAKEUPS</h3>
            </div>
            <div class="row">
                <div class="underline"></div>
            </div>
        </div>
        <div class="container mt-5 pb-5">
            <div class="row">
            @if($prodsMakeupsCount==0)
            <div class="alert alert-info" role="alert">
<h4>there is no items until now here </h4>
</div>
            @else
            @foreach($prodsMakeups as $prod)

                <div class="col-md-3">
                    <div class="card">
                    @if(!empty($prod->product_image))
            <img src="{{asset('/images/backend_images/products/small/'.$prod->product_image)}}" style="width:250px;">
            @else
            <img src="https://lh3.googleusercontent.com/proxy/pHOOPR3gEOodw8eUPwjxI6QPgaOgI_nfi0QHx04rwjd9CMInnbuF84heXiNDPlvBOY9J69ic12LmfC_DXZwRdB4N99ugpLZGtz189knY5xXfYIk-Bl74L_s" alt="">
            @endif
                        <div class="card-body">
                        <h5>{{$prod->product_name}}</h5>
                            <h6>{{$prod->product_size}}</h6>
                            <a href="/view-details-product/{{$prod->id}}">view Details</a> 

                        </div>
                    </div>
                </div>
                @endforeach
            <div class="btn_successs">

                <a href="/view-all-high-makeups"class="btn btn-success">Show More</a>
            </div>
            </div>
                @endif

        </div>
        <div class="container mt-5">
            <div class="row">
                <h3>HIGH BAGS</h3>
            </div>
            <div class="row">
                <div class="underline"></div>
            </div>
        </div>
        <div class="container mt-5 pb-5">
            <div class="row">
            @if($prodsBagsCount==0)
            <div class="alert alert-info" role="alert">
<h4>there is no items until now here </h4>
</div>
            @else
            @foreach($prodsBags as $prod)
           
                <div class="col-md-3">
                    <div class="card">
                    @if(!empty($prod->product_image))
            <img src="{{asset('/images/backend_images/products/small/'.$prod->product_image)}}" style="width:250px;">
            @else
            <img src="https://lh3.googleusercontent.com/proxy/pHOOPR3gEOodw8eUPwjxI6QPgaOgI_nfi0QHx04rwjd9CMInnbuF84heXiNDPlvBOY9J69ic12LmfC_DXZwRdB4N99ugpLZGtz189knY5xXfYIk-Bl74L_s" alt="">
            @endif
                        <div class="card-body">
                        <h5>{{$prod->product_name}}</h5>
                            <h6>{{$prod->product_size}}</h6>
                            <a href="/view-details-product/{{$prod->id}}">view Details</a> 
                           
                        </div>
                    </div>
                </div>
            
                @endforeach
            <div class="btn_successs" style="    margin-left: 925px;
    margin-top: 24px;">

                <a href="/view-all-high-bags"class="btn btn-success">Show More</a>
            </div>
            </div>
                @endif
            
        </div>

           
        </div>
<div class="container-fluid pt-5 pb-5">
	<div class="container">
		<div class="row">
			<div class="col-md-3"style="    margin-top: 28px;">
				<div class="row">
					<h4>High Quantity</h4>
				</div>

				<div class="row">
					<div class="underline-green"></div>
				</div>
            @if($prodsWantedCount==0)

            <div class="alert alert-info" role="alert">
<h4>there is no items until now here </h4>
</div>
            @else

                @foreach($prodsWanted as $prod)
				<div class="media mt-5">
                    @if(!empty($prod->product_image))
            <img src="{{asset('/images/backend_images/products/small/'.$prod->product_image)}}" style="width:250px;">
            @else
            <img src="https://lh3.googleusercontent.com/proxy/pHOOPR3gEOodw8eUPwjxI6QPgaOgI_nfi0QHx04rwjd9CMInnbuF84heXiNDPlvBOY9J69ic12LmfC_DXZwRdB4N99ugpLZGtz189knY5xXfYIk-Bl74L_s" alt="">
            @endif
					<div class="media-body mt-2" style="padding-left: 23px;">
						<h5>product name:{{$prod->product_name}}</h5>
						<h6>size:{{$prod->product_size}}</h6>
						<h6>quantity:{{$prod->product_quantity}}</h6>
                        <a href="/view-details-product/{{$prod->id}}">view Details</a> 

					</div>
				</div>
        @endforeach
        <div class="btn_success" >

            <a href="/view-all-most-wanted"class="btn btn-success">Show More</a>
        </div>
        @endif
            </div>
            <div class="feature" style="margin-left: 77px;">
            
			<div class="col-md-3">
				<div class="row">
					<h4>HIGH FEATURED</h4>
				</div>
				<div class="row">
					<div class="underline-blue"></div>
				</div>
            @if($prodsHighFeatureCount==0)
                <div class="alert alert-info" role="alert">
<h4>there is no items until now here </h4>
</div>
            @else
                @foreach($prodsHighFeature as $prod)
				<div class="media mt-5">
                    @if(!empty($prod->product_image))
            <img src="{{asset('/images/backend_images/products/small/'.$prod->product_image)}}" style="width:250px;">
            @else
            <img src="https://lh3.googleusercontent.com/proxy/pHOOPR3gEOodw8eUPwjxI6QPgaOgI_nfi0QHx04rwjd9CMInnbuF84heXiNDPlvBOY9J69ic12LmfC_DXZwRdB4N99ugpLZGtz189knY5xXfYIk-Bl74L_s" alt="">
            @endif
					<div class="media-body mt-2"style="padding-left: 23px;">
                    <h5>product name:{{$prod->product_name}}</h5>
                        <h6>size:{{$prod->product_size}}</h6>
						<h6>quantity:{{$prod->product_quantity}}</h6>
                        
                        <a href="/view-details-product/{{$prod->id}}">view Details</a> 

					</div>
				</div>
                @endforeach
			<div class="btn_success" >


                <a href="/view-all-high-feature"class="btn btn-success">Show More</a>
            </div>
                @endif
			</div>
            </div>
			<div class="price" style="margin-left: 688px;
    margin-top: -513px;">
            
			<div class="col-md-3">
				<div class="row">
					<h4>HIGH price</h4>
				</div>
				<div class="row">
					<div class="underline-black"></div>
				</div>
            @if($prodsHighPriceCount==0)


                <div class="alert alert-info" role="alert" style="    width: 230px;">
<h4>there is no items until now here </h4>
</div>
            @else
                @foreach($prodsHighPrice as $prod)
                <div class="mediaa" style="margin:10px">
                
                </div>
				<div class="media mt-5">
                    @if(!empty($prod->product_image))
            <img src="{{asset('/images/backend_images/products/small/'.$prod->product_image)}}" style="width:250px;">
            @else
            <img src="https://lh3.googleusercontent.com/proxy/pHOOPR3gEOodw8eUPwjxI6QPgaOgI_nfi0QHx04rwjd9CMInnbuF84heXiNDPlvBOY9J69ic12LmfC_DXZwRdB4N99ugpLZGtz189knY5xXfYIk-Bl74L_s" alt="">
            @endif
					<div class="media-body mt-2" style="padding-left: 23px;">
                    <h5>product name:{{$prod->product_name}}</h5>
                        <h6>price:{{$prod->product_price}}</h6>
						<h6>quantity:{{$prod->product_quantity}}</h6>
                        
                        <a href="/view-details-product/{{$prod->id}}">view Details</a> 

					</div>
				</div>
                @endforeach
				<div class="btn_success" >

                    <a href="/view-all-high-price"class="btn btn-success" >Show More</a>
                </div>
				
			</div>
                @endif
            </div>
		</div>
	</div>
	
	
</div>


        <div class="container mt-5">
            <div class="row">
                <h3>Modern</h3>
            </div>
            <div class="row">
                <div class="underline"></div>
            </div>
        </div>
        <div class="container mt-5 pb-5">
            <div class="row">
            @if($prodsHighModernCount==0)
            <div class="alert alert-info" role="alert">
<h4>there is no items until now here </h4>
</div>
            @else
            @foreach($prodsHighModern as $prod)
           
                <div class="col-md-3">
                    <div class="card">
                        @if(!empty($prod->product_image))
            <img src="{{asset('/images/backend_images/products/small/'.$prod->product_image)}}" style="width:250px;">
            @else
            <img src="https://lh3.googleusercontent.com/proxy/pHOOPR3gEOodw8eUPwjxI6QPgaOgI_nfi0QHx04rwjd9CMInnbuF84heXiNDPlvBOY9J69ic12LmfC_DXZwRdB4N99ugpLZGtz189knY5xXfYIk-Bl74L_s" alt="">
            @endif
                        <div class="card-body">
                        <h5>{{$prod->product_name}}</h5>
                            <h6>{{$prod->product_size}}</h6>
                            <a href="/view-details-product/{{$prod->id}}">view Details</a> 
                           
                        </div>
                    </div>
                </div>
            
                @endforeach
            <div class="btn_successs" style="margin-left: 962px;
    margin-top: 24px;">

                <a href="/view-all-high-modern"class="btn btn-success">Show More</a>
            </div>
            </div>
                @endif
            
        </div>

           
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
      <div class="container-fluid" id="discount" style="    width: 139%;
    margin-left: -209px;">
   	<div class="container discount-session-content">
   		<div class="row">
   			<div class="col-md-6">
   				<h1 class="text-light text-capitalize">
   					follow us on
   				</h1><br/>
   				<div class="social-icons">
   					<i class="fa fa-facebook" aria-hidden="true"></i>
   					<i class="fa fa-twitter" aria-hidden="true"></i> 
   					<i class="fa fa-instagram" aria-hidden="true"></i>
   				</div>
                   <div class="social-icons">
                   <h2>CALL US</h2>
   					<a href="/page-contact" ><i class="fa fa-phone" aria-hidden="true"></i></a>
                   
                   </div>
   			</div>
   			
   			<div class="col-md-6">
   				<h1>Subscribe to get discount<br/> coupons & new Offers!</h1>
   				<p class="discount-session-content-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt erat volutpat.</p><br/>
    <div class="input-group" style="">
      <div class="input-group-btn" style="margin-top: 5px;">
      <input type="email" class="form-control" size="50" placeholder="Email Address" required style="    width: 72%;
    height: 44px;" id="chkSubscriber" name="subscriber">
        <button type="submit" onclick="return checkSubscriber();" class="btn btn-danger" style="margin-left: 0px;">Subscribe</button>
      </div>
    </div>
  <span id="subscriberResponse"></span>
   			</div>
   			
   		</div>
   	</div>
   </div>
   
   
   
   
   <div class="container mt-5 mb-5">
   	<div class="row">
   		<div class="col-md-12 text-center text-capitalize">
   			<h1>our brand partners</h1>
   		</div>
     </div>
     <div class="container mt-5 mb-5">
   	<div class="owl-carousel owl-theme">
       <div class="row">
        <div class="col-md-3">
        
   		<div class="item">
           @if(!empty($prod->product_image))
            <img src="https://www.kenyabuzz.com/lifestyle/wp-content/uploads/2015/03/JUMIA-kenya2.png" style="width:250px;">
            @else
            <img src="https://lh3.googleusercontent.com/proxy/pHOOPR3gEOodw8eUPwjxI6QPgaOgI_nfi0QHx04rwjd9CMInnbuF84heXiNDPlvBOY9J69ic12LmfC_DXZwRdB4N99ugpLZGtz189knY5xXfYIk-Bl74L_s" alt=""style="border-raduis:50%">
            @endif
           </div>
        </div>
        <div class="col-md-3">
        
        <div class="item">
        @if(!empty($prod->product_image))
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQ3BBQZU8E2-3JR12L85_ckqSROp-lGuhbqP47jGSTaN9LvIh3z&usqp=CAU" style="width:250px;border-raduis:50% !important;">
            @else
            <img src="https://lh3.googleusercontent.com/proxy/pHOOPR3gEOodw8eUPwjxI6QPgaOgI_nfi0QHx04rwjd9CMInnbuF84heXiNDPlvBOY9J69ic12LmfC_DXZwRdB4N99ugpLZGtz189knY5xXfYIk-Bl74L_s" alt=""style="border-raduis:50%">
            @endif
        </div>
     </div>
     <div class="col-md-3">
        
        <div class="item">
        @if(!empty($prod->product_image))
            <img src="https://www.kenyabuzz.com/lifestyle/wp-content/uploads/2015/03/JUMIA-kenya2.png" style="width:250px;">
            @else
            <img src="https://lh3.googleusercontent.com/proxy/pHOOPR3gEOodw8eUPwjxI6QPgaOgI_nfi0QHx04rwjd9CMInnbuF84heXiNDPlvBOY9J69ic12LmfC_DXZwRdB4N99ugpLZGtz189knY5xXfYIk-Bl74L_s" alt=""style="border-raduis:50%">
            @endif
        </div>
     </div>
     <div class="col-md-3">
        
        <div class="item">
        @if(!empty($prod->product_image))
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQ3BBQZU8E2-3JR12L85_ckqSROp-lGuhbqP47jGSTaN9LvIh3z&usqp=CAU" style="width:250px;">
            @else
            <img src="https://lh3.googleusercontent.com/proxy/pHOOPR3gEOodw8eUPwjxI6QPgaOgI_nfi0QHx04rwjd9CMInnbuF84heXiNDPlvBOY9J69ic12LmfC_DXZwRdB4N99ugpLZGtz189knY5xXfYIk-Bl74L_s" alt="" style="border-raduis:50%">
            @endif
        </div>
     </div>
   		
       </div>
   	</div>
   <footer class="container-fluid mt-5" style="width: 150%;
    margin-left: -235px;margin-bottom: -74px;">
   	<div class="container pt-5 pb-5">
   		<div class="row">
   			<div class="col-md-6">
   				<h3 style="color:black;">WEBSEOTIPS.COM</h3>
   				<p style="color:black;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia et eligendi at illo? Repellendus explicabo earum ab repudiandae fugit et eaque iusto cumque labore! At, accusamus explicabo reprehenderit natus cumque!</p>
   			
   			</div>
   			
   			<div class="col-md-3">
   			<h3 style="color:black;">Latest products</h3>
   				<div class="media mt-5"> 
                   @if(!empty($prod->product_image))
            <img src="{{asset('/images/backend_images/products/small/8248.jpg')}}" style="width:250px;">
            @else
            <img src="https://lh3.googleusercontent.com/proxy/pHOOPR3gEOodw8eUPwjxI6QPgaOgI_nfi0QHx04rwjd9CMInnbuF84heXiNDPlvBOY9J69ic12LmfC_DXZwRdB4N99ugpLZGtz189knY5xXfYIk-Bl74L_s" alt="">
            @endif
   				<div class="media-body">
   					<h5 style="color:black;">Woman's Dress</h5>
   					<del style="color:black;">$80</del> &nbsp; $70
   				</div>
   					
   				</div>
   				
   				<div class="media mt-5"> 
                   @if(!empty($prod->product_image))
            <img src="{{asset('/images/backend_images/products/small/8683.jpg')}}" style="width:250px;">
            @else
            <img src="https://lh3.googleusercontent.com/proxy/pHOOPR3gEOodw8eUPwjxI6QPgaOgI_nfi0QHx04rwjd9CMInnbuF84heXiNDPlvBOY9J69ic12LmfC_DXZwRdB4N99ugpLZGtz189knY5xXfYIk-Bl74L_s" alt="">
            @endif
   				<div class="media-body">
   					<h5style="color:black;" >Woman's Top</h5>
   					<del style="color:black;">$80</del> &nbsp; $70
   				</div>
   					
   				</div>
   			</div>
   			<div class="col-md-3">
   			<h3 style="color:black;">Top Rated products</h3>
   				<div class="media mt-5">
                    @if(!empty($prod->product_image))
            <img src="{{asset('/images/backend_images/products/small/7957.jpg')}}" style="width:250px;">
            @else
            <img src="https://lh3.googleusercontent.com/proxy/pHOOPR3gEOodw8eUPwjxI6QPgaOgI_nfi0QHx04rwjd9CMInnbuF84heXiNDPlvBOY9J69ic12LmfC_DXZwRdB4N99ugpLZGtz189knY5xXfYIk-Bl74L_s" alt="">
            @endif
   				<div class="media-body">
   					<h5 style="color:black;">Man's Dress</h5>
   					<del style="color:black;">$80</del> &nbsp; $70
   				</div>
   					
   				</div>
   				
   				<div class="media mt-5">
                    @if(!empty($prod->product_image))
            <img src="{{asset('/images/backend_images/products/small/709.jpg')}}" style="width:250px;">
            @else
            <img src="https://lh3.googleusercontent.com/proxy/pHOOPR3gEOodw8eUPwjxI6QPgaOgI_nfi0QHx04rwjd9CMInnbuF84heXiNDPlvBOY9J69ic12LmfC_DXZwRdB4N99ugpLZGtz189knY5xXfYIk-Bl74L_s" alt="">
            @endif
   				<div class="media-body">
   					<h5 style="color:black;">hand bresslare</h5>
   					<del style="color:black;">$80</del> &nbsp; $70
   				</div>
   					
   				</div>
   			</div>
                <h4 style="    margin-left: 337px;
    margin-top: 29px;
    background-color: #ff6aa5;">Develped By Eng-Alaa Badra</h4>
   		</div>
   	</div>
   </footer> 
   </div>
   </div>
   <script>
   function checkSubscriber(){
 var subscriber = $("#chkSubscriber").val();
 if(subscriber==""){
  alert("Please enter Pincode"); return false; 
 }
 $.ajax({
  type:'post',
  data:{subscriber:subscriber},
  url:'/check-subscriber-email',
  success:function(resp){
   if(resp=='exist'){
     $("#subscriberResponse").html("<font color='red'>your email made   subscribe before time </font>"); 
   }else{
     $("#subscriberResponse").html("<font color='blue'>your email success in making subscribe in our website,thank you...</font>");

   }
  },error:function(){
   alert("Error");
  }
 });
}
   </script>
   @endsection