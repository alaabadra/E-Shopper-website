

@extends('layout')

@section('title')
    index 
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

  <section id="slider">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div id="slider-carsousel" class="carousel slide" data-ride="carousel">
          @foreach($banners as $key => $banner)
            <ol class="carousel-indicators">
                <li data-target="#slider-carousel" data-slide-to="0"  @if($key==0)  class="active" @endif ></li>
                <!-- <li data-target="#slider-carousel" data-slide-to="1" ></li>
                <li data-target="#slider-carousel" data-slide-to="2" ></li>
                <li data-target="#slider-carousel" data-slide-to="3" ></li> -->
            </ol>
            @endforeach
            <div class="carousel-inner">
                @foreach($banners as $key => $banner)
                  <div class="item @if($key==0) class='active' @endif">
                  <a href="{{$banner->banner_link}}" title="{{$banner->banner_title}}"  ></a>
                  <img src="images/frontend_images/banners/{{$banner->banner_image}}" alt="">
                  </div>
                @endforeach
                <!-- <div class="item active">
                  <a href="products/t-shirts" title="Banner 1"  ><img src="{{asset('/images/frontend_images/banners/banner1.png')}}" alt=""></a>
                </div>
                <div class="item">
                  <img src="{{asset('/images/frontend_images/banners/banner2.png')}}" alt="">
                </div>
                <div class="item">
                  <img src="{{asset('/images/frontend_images/banners/banner3.png')}}" alt="">
                </div> -->

            </div>
          <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
            <i class="fa fa-angle-left"></i>
          </a>
          <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="prev">
            <i class="fa fa-angle-right"></i>
          </a>
          </div>
        </div>
        </div>
      </div>
  </section>
  @endsection
