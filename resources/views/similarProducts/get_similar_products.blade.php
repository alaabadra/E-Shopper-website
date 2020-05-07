@extends('layout')
@section('content')
<style>
         body{
        margin:0;
        padding:0;
        background-color:#ffefef;
    }
</style>
<div class="widget-content nopadding">
<table id="table_id" class="table table-bordered data-table">
    <thead>
        <tr>
            <th>similar product id</th>
            <th>product_name</th>
            <th>product_image</th>
            <th>product_status</th>
      
            <th>actions</th>
            
         
        </tr>
    </thead>
    <tbody>
@foreach($getAllSimProd as $SimProd)

        <tr class="gradeX">

            <td>{{$SimProd->id}}</td>
            <td>{{$SimProd->product_name}}</td>
            <td>{{$SimProd->product_image}}</td>
            <td>{{$SimProd->product_status}}</td>
          <td>
          
         <a target="_blank" href="{{url('edit-cat/'.$SimProd->id)}}">view order details</a><br>
         <a target="_blank" href="{{url('delete-cat/'.$SimProd->id)}}">view order invoice</a>
          </td>
 
        </tr>
    </tbody>
@endforeach


</div>
@endsection