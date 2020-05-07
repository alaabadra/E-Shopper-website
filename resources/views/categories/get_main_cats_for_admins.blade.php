@extends('layout')
@section('title')
    VIEW BANNERS Page
@endsection
@section('content')
<a class="btn btn-small btn-info text-dark ml-5"href="{{url('/add-category')}}" >add category</a>
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
    margin-left: 298px;
    width: 64%;
    margin-top: 38px;
    border-radius: 15%;
">
                    
                    <thead>
        <tr>
            <th>cat id</th>
            <th>category Name</th>
      
            <th>actions</th>
            
         
        </tr>
    </thead>
    <tbody>
@foreach($getMainCats as $category)

        <tr class="gradeX">

            <td>{{$category->id}}</td>
            <td>{{$category->category_name}}</td>
          <td>
          
         <ul style="list-style: none;">
                  <li class="nav-item">
                  <a class="btn btn-small btn-info text-dark ml-5"href="{{url('/add-sub-category/'.$category->id)}}" >add sub category</a>

                      <a class="btn btn-small btn-info text-dark ml-5"href="{{url('/get-sub-cats-for-admins/'.$category->id)}}" >view </a>
                      <a class="btn btn-small btn-info text-dark ml-5"href="{{url('edit-parent-category/'.$category->id)}}" >edit </a>
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