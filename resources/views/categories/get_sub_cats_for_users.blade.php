

@extends('layout')

@section('title')
    Category Page
@endsection

@section('content')
@if(Session::has('flash_message_error'))
    <div class="alert alert-error alert-block">
        <strong>{!!session('flash_message_error')!!}</strong>
    </div>
@endif

@if(Session::has('flash_message_success'))
    <div class="alert alert-success alert-block">
        <strong>{!!session('flash_message_success')!!}</strong>
    </div>
@endif
<style>
/*-----------------
Cards
------------------*/
body{
        margin:0;
        padding:0;
        background-color:#ffefef;
    }
.main-cont{
    padding: 0;
    margin: 0;
    top: -215px;
}

.news-row {
	margin: 0;
    margin-top: 50px;
    margin-bottom: 50px;
}

.news-block{
    margin: auto;
    padding: 0;
    background-color: transparent;
    max-width: 1060px;
    min-width: 100px;
    border: 20px solid transparent;
    -o-border-image: linear-gradient(to bottom right,rgba(255, 255, 255, 0.75) 0%,rgba(245, 245, 245, 0.75) 0%,rgba(245, 245, 245, 0.75) 16.6%,rgb(245, 245, 245) 37.8%,rgb(245, 245, 245) 48.8%,rgb(254, 254, 254) 53.1%,rgba(245, 245, 245, 0.75) 79.4%,rgba(245, 245, 245, 0.75) 84.3%) !important;
       border-image: -webkit-gradient(linear,left top, right bottom,from(rgba(255, 255, 255, 0.75)),color-stop(0%, rgba(245, 245, 245, 0.75)),color-stop(16.6%, rgba(245, 245, 245, 0.75)),color-stop(37.8%, rgb(245, 245, 245)),color-stop(48.8%, rgb(245, 245, 245)),color-stop(53.1%, rgb(254, 254, 254)),color-stop(79.4%, rgba(245, 245, 245, 0.75)),color-stop(84.3%, rgba(245, 245, 245, 0.75))) !important;
       border-image: linear-gradient(to bottom right,rgba(255, 255, 255, 0.75) 0%,rgba(245, 245, 245, 0.75) 0%,rgba(245, 245, 245, 0.75) 16.6%,rgb(245, 245, 245) 37.8%,rgb(245, 245, 245) 48.8%,rgb(254, 254, 254) 53.1%,rgba(245, 245, 245, 0.75) 79.4%,rgba(245, 245, 245, 0.75) 84.3%) !important;
    border-image-slice: 1 !important;
    -webkit-transition: all 0.6s ease;
    transition: all 0.6s ease;
    -webkit-animation: blockAppear .6s ease-in-out;
            animation: blockAppear .6s ease-in-out;
    -webkit-animation-duration: 1s;
            animation-duration: 1s;
}

.underlay{
  /*display: none;*/
  margin: 0;
  padding: 0;
  max-height: 350px;
  max-width: 340px;
}

.card{
    margin: 0;
    width: 340px;
    max-height: 350px;
    max-width: 340px;
    background-color: transparent;
    border: 20px solid transparent !important;
    -o-border-image: linear-gradient(to bottom right,rgba(255, 255, 255, 0.75) 0%,rgba(245, 245, 245, 0.75) 0%,rgba(245, 245, 245, 0.75) 16.6%,rgba(245, 245, 245, 0.75) 79.4%,rgba(245, 245, 245, 0.75) 84.3%) !important;
       border-image: -webkit-gradient(linear,left top, right bottom,from(rgba(255, 255, 255, 0.75)),color-stop(0%, rgba(245, 245, 245, 0.75)),color-stop(16.6%, rgba(245, 245, 245, 0.75)),color-stop(79.4%, rgba(245, 245, 245, 0.75)),color-stop(84.3%, rgba(245, 245, 245, 0.75))) !important;
       border-image: linear-gradient(to bottom right,rgba(255, 255, 255, 0.75) 0%,rgba(245, 245, 245, 0.75) 0%,rgba(245, 245, 245, 0.75) 16.6%,rgba(245, 245, 245, 0.75) 79.4%,rgba(245, 245, 245, 0.75) 84.3%) !important;
    border-image-slice: 1 !important;
    -webkit-transition: -webkit-transform 0.6s ease;
    transition: -webkit-transform 0.6s ease;
    transition: transform 0.6s ease;
    transition: transform 0.6s ease, -webkit-transform 0.6s ease;
    -webkit-animation: blockAppear .6s ease-in-out;
            animation: blockAppear .6s ease-in-out;
    -webkit-animation-duration: 1.5s;
            animation-duration: 1.5s;
}

@-webkit-keyframes blockAppear {
  0% {
    opacity: 0;
    -webkit-transform: translateY(20px) ;
            transform: translateY(20px) ;
  }
  ready.css:1
  40% {
    opacity: 0;
    -webkit-transform: translateY(20px);
            transform: translateY(20px);
    -webkit-box-shadow: 0 10px 35px rgba(0,0,0,.15), 0 1px 0 rgba(0,0,0,.15);
            box-shadow: 0 10px 35px rgba(0,0,0,.15), 0 1px 0 rgba(0,0,0,.15);
  }
  ready.css:1
  80% {
    opacity: 1;
    -webkit-transform: translateY(-5px);
            transform: translateY(-5px);
  }
  ready.css:1
  100% {
    opacity: 1;
    -webkit-transform: translateY(0);
            transform: translateY(0);
    -webkit-box-shadow: none;
            box-shadow: none;
  }
}

@keyframes blockAppear {
  0% {
    opacity: 0;
    -webkit-transform: translateY(20px) ;
            transform: translateY(20px) ;
  }
  ready.css:1
  40% {
    opacity: 0;
    -webkit-transform: translateY(20px);
            transform: translateY(20px);
    -webkit-box-shadow: 0 10px 35px rgba(0,0,0,.15), 0 1px 0 rgba(0,0,0,.15);
            box-shadow: 0 10px 35px rgba(0,0,0,.15), 0 1px 0 rgba(0,0,0,.15);
  }
  ready.css:1
  80% {
    opacity: 1;
    -webkit-transform: translateY(-5px);
            transform: translateY(-5px);
  }
  ready.css:1
  100% {
    opacity: 1;
    -webkit-transform: translateY(0);
            transform: translateY(0);
    -webkit-box-shadow: none;
            box-shadow: none;
  }
}

.card:hover{
    z-index: 999;
    max-height: 800px;
    width: 400px;
    max-width: 400px;
    border: none !important;
    border-right: 60px solid transparent !important;
    border-bottom: 20px solid transparent !important;
    margin-right: -20px;
	  -webkit-transform:  translate(-30px, -50px);
	          transform:  translate(-30px, -50px);
}

.card:before{
  -webkit-box-shadow: none;
          box-shadow: none;
  display: block;
  content: '';
  position: absolute;
  width: 100%;
  max-width: 400px;
  height: 100%;
  -webkit-transition: -webkit-box-shadow 0.6s ease;
  transition: -webkit-box-shadow 0.6s ease;
  transition: box-shadow 0.6s ease;
  transition: box-shadow 0.6s ease, -webkit-box-shadow 0.6s ease;
}

.card:hover:before
{
  max-width: 300px;
  -webkit-box-shadow: 60px 60px 20px RGBA(142, 142, 142, .6);
          box-shadow: 60px 60px 20px RGBA(142, 142, 142, .6);
}

.card:hover .card-img-top{
	height: 300px;
}

.card:hover .card-block {
  width: 300px;
	background-image: -webkit-gradient(linear,right bottom, left top,from(rgb(72, 85, 108)),color-stop(50%, rgb(27, 33, 43)),color-stop(51%, rgb(20, 25, 34)),to(rgb(53, 59, 69)));
	background-image: linear-gradient(to top left,rgb(72, 85, 108) 0%,rgb(27, 33, 43) 50%,rgb(20, 25, 34) 51%,rgb(53, 59, 69) 100%);
}

.card:hover .card-title{
    color: white;
}

.card:hover .card-text{
	  /*display: block !important;*/
    color: white;
}

.card-block{
    background-color: transparent;
    background-image: -webkit-gradient(linear,left top, right bottom,from(rgba(255, 255, 255, 0.75)),color-stop(0%, rgba(245, 245, 245, 0.75)),color-stop(16.6%, rgba(245, 245, 245, 0.75)),color-stop(37.8%, rgb(245, 245, 245)),color-stop(48.8%, rgb(245, 245, 245)),color-stop(53.1%, rgb(254, 254, 254)),color-stop(79.4%, rgba(245, 245, 245, 0.75)),color-stop(84.3%, rgba(245, 245, 245, 0.75)));
    background-image: linear-gradient(to bottom right,rgba(255, 255, 255, 0.75) 0%,rgba(245, 245, 245, 0.75) 0%,rgba(245, 245, 245, 0.75) 16.6%,rgb(245, 245, 245) 37.8%,rgb(245, 245, 245) 48.8%,rgb(254, 254, 254) 53.1%,rgba(245, 245, 245, 0.75) 79.4%,rgba(245, 245, 245, 0.75) 84.3%);
    background-repeat: no-repeat;
}

.card-text {
	display: none;
}

.card-img-top{
    width: 300px;
    height: 250px;
    background-color: #fff;
    -webkit-transition: height 0.8s ease;
    transition: height 0.8s ease;
}

@media (max-width: 1120px){
    .bar-cont{
        width: 100%;
    }
    .news-block{
       max-width: 720px;
    }
    .card:hover{
      margin-right: -20px;
    }
    .card:hover .card-block{
      width: 300px;
    }
}

@media (max-width: 800px){
    .news-block{
       min-width: 380px;
    }
    .card:hover{
      border-left: 20px solid transparent !important;
      margin-right: -40px;
      -webkit-transform:  translate(0, -50px);
              transform:  translate(0, -50px);
    }
    .card:hover:before{
      -webkit-box-shadow: 0px 60px 40px RGBA(142, 142, 142, .5);
              box-shadow: 0px 60px 40px RGBA(142, 142, 142, .5);
    }
    .card:hover .card-block{
      width: 300px;
    }
}

@media (max-width: 580px){
  .news-block{
     max-width: 380px;
  }
}
.header{
    font-family: fantasy;
}
.header:hover{
  color:#ff00bc;
}
.image:hover{
	transform: scale(1.6)


}
image{
	transition: all 0.5s ease;

}
.container:hover .image {
  opacity: 100%;
}
</style>
<div class="header">
<h1 style="margin-left: 575px;">All Categories for {{$MainCat->category_name}}</h1>

</div>


<div align="left" style="     margin-left: 79px;
    margin-bottom: 38px;">
  <?php echo $breadcrumb?>
</div>

@if($SubCatsCount==0)
            <div class="alert alert-info" role="alert">
<h4 >there is no categories here  until now for this products , will be soon </h4>
</div>
            @else

        <!-- <div class="middle">
    <div class="text">John Doe</div>
  </div> -->
 
              <!-- <div class="u-flexbox u-align-items-center u-cursor-pointer">
              <div class="c-icon c-icon--small c-icon--cg6" data-icon-name="heart"> -->
              <!-- <svg viewBox="0 0 16 16">
              <path d="M11.73 1C9.58 1 8 2.74 8 2.74S6.42 1 4.27 1c-.7 0-1.48.2-2.28.7-2.92 1.88-2.47 5.86.34 8.5A83.4 83.4 0 0 0 8 15s3.04-2.32 5.67-4.8c2.81-2.64 3.26-6.62.34-8.5-.8-.5-1.57-.7-2.28-.7m0 1.5c.5 0 .98.15 1.47.47.77.5 1.2 1.2 1.29 2.07.12 1.33-.59 2.88-1.85 4.07A79.25 79.25 0 0 1 8 13.1a79.1 79.1 0 0 1-4.64-3.98C2.1 7.93 1.39 6.37 1.51 5.05c.09-.89.52-1.59 1.3-2.08.48-.32.96-.47 1.46-.47 1.44 0 2.62 1.25 2.62 1.25L8 4.97l1.1-1.22c.02-.01 1.21-1.25 2.63-1.25">
              </path>
              
              </svg> -->
 
    
    <div class="container-fluid main-cont">
      <div class="row" style="    margin-left: 65px;">
      @foreach($SubCats as $getCat)

        <?php
                 $categoryStatus= $getCat->category_status;
                ?>
                
                <div class="col-md-3" style="    margin-bottom: 48px;">
                        <a href="/get-products-for-users/{{$getCat->id}}/{{$getCat->category_url}}"style="    margin-left: 57px;
    font-size: 24px;">{{$getCat->category_name}}</a>
  
                    <div class="card" style="    background-color: #ff00bc4d;    margin-top: 21px;">
                        @if(!empty($getCat->category_image))
            <img style="    width: 301px;
    height: 252px;
    object-fit: cover;" src="{{asset('/images/backend_images/products/small/'.$getCat->category_image)}}">
            @else
            <img src="https://lh3.googleusercontent.com/proxy/pHOOPR3gEOodw8eUPwjxI6QPgaOgI_nfi0QHx04rwjd9CMInnbuF84heXiNDPlvBOY9J69ic12LmfC_DXZwRdB4N99ugpLZGtz189knY5xXfYIk-Bl74L_s" alt="">
            @endif
                        <div class="card-body">
                        <h5></h5>
                            <h6>{{$getCat->product_desc}}</h6>
                            @if($categoryStatus==0)
                              <a href="" class="btn btn-danger" style="margin-left: 41px;">Will Be Soon Open</a>
                            @elseif($categoryStatus==1)
                            <a href="" class="btn btn-warning"style="margin-left: 41px;">Products in it  Will finish Soon</a>
                            @elseif($categoryStatus==2)
                            <a href="" class="btn btn-info"style="margin-left: 41px;">Products in it   is Enough</a>
                            @endif
                        </div>
                    </div>
                </div>
           
               @endforeach
          @endif
            </div>









</div><br><br>


<!--  -->
<!-- <h2>Opacity with Box</h2>
<p>Hover over the image to see the effect.</p>

<div class="container">
  <img src="img_avatar.png" alt="Avatar" class="image" style="width:100%">
  <div class="middle">
    <div class="text">John Doe</div>
  </div>
</div> -->
   
   
@endsection