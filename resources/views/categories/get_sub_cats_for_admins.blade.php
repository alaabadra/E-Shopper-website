@extends('layout')
@section('title')
    VIEW BANNERS Page
@endsection
@section('content')
<a class="btn btn-small btn-info text-dark ml-5"href="{{url('/add-product')}}" >add product</a>

<div class="widget-content nopadding">
<table id="table_id" class="table table-bordered data-table">
    
    <div class="container-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title"> <span><i class="icon-th"></i></span>
                    <h1 style="    margin-left: 590px;">view categories</h1>

                </div>
                <div class="widget-content nopadding">
                    <table class="table table-bordered data-table"style="    border: 4px solid #493641;
    margin-left: 78px;
    width: 90%;
    margin-top: 38px;
    border-radius: 15%;
">
                    <thead>
        <tr>
            <th>cat id</th>
            <th>category Name</th>
            <th>category Image</th>
            <th>category Url</th>
            <th>category Status</th>
      
            <th>actions</th>
            
         
        </tr>
    </thead>
    <tbody>
@foreach($SubCats as $category)

        <tr class="gradeX">

            <td>{{$category->id}}</td>
            <td>{{$category->category_name}}</td>
            <td>
            @if(!empty($category->category_image))
            <img src="{{asset('/images/backend_images/products/small/'.$category->category_image)}}" style="    width: 123px;
    margin-left: 149px;">
             @else
            <img src="https://lh3.googleusercontent.com/proxy/pHOOPR3gEOodw8eUPwjxI6QPgaOgI_nfi0QHx04rwjd9CMInnbuF84heXiNDPlvBOY9J69ic12LmfC_DXZwRdB4N99ugpLZGtz189knY5xXfYIk-Bl74L_s" alt="">
            @endif
            </td>
            <td>{{$category->category_url}}</td>
            <td>
            
            @if($category->category_status==0)
                <a href="" class="btn btn-danger">Will be Soon</a>
            @elseif($category->category_status==1)
                <a href="" class="btn btn-warning">Will finish</a>
            @else
            <a href="" class="btn btn-success">Exsit quantity is Enough</a>
            @endif
            </td>
          <td>
              
        
         <ul style="list-style: none;">
                  <li class="nav-item">

                      <a class="btn btn-small btn-info text-dark ml-5"href="{{url('/get-products-for-admins/'.$category->id)}}" >view </a>
                      <a class="btn btn-small btn-info text-dark ml-5"href="{{url('edit-sub-category/'.$category->id)}}" >edit </a>
                      <a class="btn btn-small btn-danger text-dark ml-5"href="{{url('delete-category/'.$category->id)}}" >delete</a>
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