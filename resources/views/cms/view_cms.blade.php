@extends('layout')
@section('title')
    VIEW BANNERS Page
@endsection
@section('content')
<a class="btn btn-small btn-info text-dark ml-5"href="{{url('/add-cms')}}" >add cms</a>
<div class="widget-content nopadding">
<table id="table_id" class="table table-bordered data-table">
    
    <div class="container-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title"> <span><i class="icon-th"></i></span>
                    <h1 style="    margin-left: 590px;">view CMS</h1>
                </div>
                <div class="widget-content nopadding">
                    <table class="table table-bordered data-table"style="    border: 4px solid #493641;
    margin-left: 107px;
    width: 88%;
    margin-top: 38px;
    border-radius: 15%;
">
                    <thead>
        <tr>
            <th>title</th>
            <th>description</th>
            <th>url</th>
            <th>status</th>
      
            <th>actions</th>
            
         
        </tr>
    </thead>
    <tbody>
@foreach($allCms as $cms)

        <tr class="gradeX">

            <td>{{$cms->title}}</td>
            <td>{{$cms->description}}</td>
            <td>{{$cms->url}}</td>
            <td>{{$cms->status}}</td>
          <td>
          <ul>
                  <li class="nav-item">

                      <a class="btn btn-small btn-info text-dark ml-5"href="{{url('edit-cms/'.$cms->id)}}" >edit </a>
                      <a class="btn btn-small btn-danger text-dark ml-5"href="{{url('delete-cms/'.$cms->id)}}" >delete</a>
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