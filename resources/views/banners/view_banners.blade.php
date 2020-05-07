@extends('layout')
@section('title')
    VIEW BANNERS Page
@endsection
@section('content')
<div class="widget-content nopadding">
<table id="table_id" class="table table-bordered data-table">
<a class="btn btn-small btn-info text-dark ml-5"href="{{url('/add-banner')}}" >add banner</a>
    
    <div class="container-fluid">
        <div class="span12">
            <div class="widget-box">
            <div class="widget-title"> <span><i class="icon-th"></i></span>
                    <h2  style="    margin-left: 590px;">view banners</h2>
                </div>
                <div class="widget-content nopadding">
                    <table class="table table-bordered data-table"style="    border: 4px solid #493641;
    margin-left: 107px;
    width: 88%;
    margin-top: 38px;
    border-radius: 15%;
">
                    
                    <thead>
                        <tr >
                            <th>banner id</th>
        
                            <th>banner Status</th>
                            <th>banner image</th>
                    
                            <th>actions</th>
                            
                        
                        </tr>
                    </thead>
                    <tbody>
                @foreach($banners as $banner)

                        <tr class="gradeX">

                            <td class="center">{{$banner->id}}</td>
                            <!-- <td class="center">{{$banner->banner_title}}</td>
                            <td class="center">{{$banner->banner_link}}</td> -->
                            <td class="center">
                            @if($banner->banner_status==0)
                                <a href="" class="btn btn-danger">Not Ready to show it Now</a>
                            @else
                            <a href="" class="btn btn-success"> Ready to show it Now</a>
                            @endif
                            </td>

                            <td class="center">
                            @if(!empty($banner->banner_image))
                            <img src="{{asset('/images/frontend_images/banners/'.$banner->banner_image)}}" style="width:250px;">
                            @else
        <img src="https://lh3.googleusercontent.com/proxy/pHOOPR3gEOodw8eUPwjxI6QPgaOgI_nfi0QHx04rwjd9CMInnbuF84heXiNDPlvBOY9J69ic12LmfC_DXZwRdB4N99ugpLZGtz189knY5xXfYIk-Bl74L_s" alt="">
        @endif
                            </td>
                        <td>
                        <ul>
                                <li class="nav-item">
                                    <a class="btn btn-small btn-info text-dark ml-5"href="{{url('edit-banner/'.$banner->id)}}" >edit </a>
                                    <a class="btn btn-small btn-danger text-dark ml-5"href="{{url('delete-banner/'.$banner->id)}}" >delete</a>
                                </li>
                            </ul>
                        </td>
                
                        </tr>
                    </tbody>
                    @endforeach
                    </table>
                </div>



            </div>
        </div>
    </div>


</div>
@endsection