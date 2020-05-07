

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
<a target="_blank" href="{{url('add-product/')}}">add product</a><br>

    <thead>
        <tr>
            <th>product id</th>
            <th>product_name</th>
            <th>product_image</th>
            <th>product_url</th>
      
            <th>actions</th>
            
         
        </tr>
    </thead>
    <tbody>
@foreach($similarproducts as $product)

        <tr class="gradeX">

            <td>{{$product->id}}</td>
            <td>{{$product->product_name}}</td>
            <td>{{$product->product_image}}</td>
            <td>{{$product->product_url}}</td>
          <td>
          
          <a target="_blank" href="{{url('edit-product/'.$product->id)}}">edit product</a><br>
         <a target="_blank" href="{{url('delete-product/'.$product->id)}}">delete product</a>
          </td>
 
        </tr>
    </tbody>
@endforeach


</div>
@endsection