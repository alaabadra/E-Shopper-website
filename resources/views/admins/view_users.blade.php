@extends('layout')
@section('title')
    VIEW BANNERS Page
@endsection
@section('content')
<div class="widget-content nopadding">
<ul style=" list-style-type: none;">
<li class="nav-item">
<a class="btn btn-small btn-info text-dark ml-5"href="{{url('/admin/view-users-charts')}}" ><i class="glyphicon glyphicon-user" aria-hidden="true"></i> view users in charts</a>
<a class="btn btn-small btn-info text-dark ml-5"href="{{url('/admin/add-user')}}" ><i class="glyphicon glyphicon-user" aria-hidden="true"></i> add user</a>
</li>
</ul>

    
    <div class="container-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title"> <span><i class="icon-th"></i></span>
                    <h2  style="    margin-left: 590px;">view Users</h2>

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
            <th>name</th>
            <th>email</th>
            <th>password</th>
            <th>created_at</th>
            <th>updated_at</th>
            <th>actions</th>
            
         
        </tr>
    </thead>
    <tbody>
@foreach($users as $user)
<?php

$decPass= Crypt::decryptString($user->password);
?>

        <tr class="gradeX">

            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$decPass}}</td>
            <td>{{$user->created_at}}</td>
            <td>{{$user->updated_at}}</td>
          <td>
          <ul style=" list-style-type: none;
 
    ">
                  <li class="nav-item">

                      <a class="btn btn-small btn-info text-dark ml-5"href="{{url('/admin/edit-user/'.$user->id)}}"style="margin-top: 3px;" >edit </a>
                      <li class="nav-item" style="    margin-left: 61px;
    margin-top: -34px;">
                      
                      <a class="btn btn-small btn-danger text-dark ml-5"href="{{url('/admin/delete-user/'.$user->id)}}" >delete</a>
                      </li>
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