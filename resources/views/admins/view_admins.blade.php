
@extends('layout')
@section('title')
    VIEW ADMINS Page
@endsection
@section('content')
<div class="widget-title"> <span><i class="icon-th"></i></span>
                    <h1 style="    margin-left: 590px;">view Admins</h1>
<div class="widget-content nopadding">
<a class="btn btn-small btn-info text-dark ml-5"href="{{url('/admin/add-admin')}}" ><i class="glyphicon glyphicon-user" aria-hidden="true"></i> add admin</a>
<table id="table_id" class="table table-bordered data-table"style="     border: 4px solid #493641;
    margin-left: 71px;
    width: 88%;
    margin-top: 38px;
    border-radius: 15%;
">
    <thead>
        <tr>
            <th>name</th>
            <th>email</th>
            <th>password</th>
            <th>type</th>
            <th>status</th>
            <th>category edit access</th>
            <th>carts access</th>
            <th>products access</th>
            <th>users access</th>
      
            <th>actions</th>
            
         
        </tr>
    </thead>
    <tbody>
@foreach($admins as $admin)
<?php
         $decPass= Crypt::decryptString($admin->password);

    //echo $decPass;
?>
        <tr class="gradeX">
 
            <td>{{$admin->name}}</td>
            <td>{{$admin->email}}</td>
            <td>{{$decPass}}</td>
            <td>{{$admin->type}}</td>

            <td>
            
            @if($admin->status==0)
                <a href="" class="btn btn-warning">Will be ACTIVE his rules soon</a>
            @else
            <a href="" class="btn btn-success">ativated his rules</a>
            @endif
            </td>
       
              <td>
            @if($admin->categories_edit_access==0)
                <a href="" class="btn btn-danger">have not  the RULE</a>
            @else
            <a href="" class="btn btn-success">have  the RULE</a>
            @endif
            </td>

            <td>
            @if($admin->carts_access==0)
                <a href="" class="btn btn-danger">have not the RULE</a>
            @else
            <a href="" class="btn btn-success">have  the RULE</a>
            @endif
            </td>

            <td>
            @if($admin->products_access==0)
                <a href="" class="btn btn-danger">have not the RULE</a>
            @else
            <a href="" class="btn btn-success">have  the RULE</a>
            @endif
           </td>

            <td>
            @if($admin->users_access==0)
                <a href="" class="btn btn-danger">have not the RULE</a>
            @else
            <a href="" class="btn btn-success">have  the RULE</a>
            @endif
            </td>
          <td>
          <ul style=" list-style-type: none;
    margin-left: -46px;
    ">
                  <li class="nav-item" style="margin-left: -21px;
    margin-top: -4px;">

                      <a class="btn btn-small btn-info text-dark ml-5"href="{{url('/admin/edit-admin/'.$admin->id)}}"style="margin-top: 3px;" >edit </a>
                      <li class="nav-item" style="margin-left: 37px;
    margin-top: -34px;">
                      
                      <a class="btn btn-small btn-danger text-dark ml-5"href="{{url('/admin/delete-admin/'.$admin->id)}}" >delete</a>
                      </li>
                  </li>
              </ul>
      
          </td>
 
        </tr>
    </tbody>
@endforeach

<table>
</div>
@endsection