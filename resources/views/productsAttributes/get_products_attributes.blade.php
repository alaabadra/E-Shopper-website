@extends('layout')
@section('title')
    VIEW product attribute Page
@endsection
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
<a class="btn btn-small btn-info text-dark ml-5"href="{{url('/add-product-attribute')}}" >add product attribute</a>
    
    <div class="container-fluid">
        <div class="span12">
        <div class="widget-title"> <span><i class="icon-th"></i></span>
                    <h2  style="    margin-left: 590px;">view products attributes</h2>
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
            <th>Product Id</th>
            <th>Product Size</th>
            <th>Product Price</th>
            <th>Product Code</th>
            <th>Product Color</th>
            <th>Product Status</th>
            <th>Product Name</th>
            <th>Product Image</th>
            <th>Pincode</th>
      
            <th>Actions</th>
            
         
        </tr>
    </thead>
    <tbody>
@foreach($ProductsAttributes as $prodsAtt)

        <tr class="gradeX">

            <td>{{$prodsAtt->product_id}}</td>
            <td>{{$prodsAtt->product_size}}</td>
            <td>{{$prodsAtt->product_price}}</td>
            <td>{{$prodsAtt->product_code}}</td>
            <td>{{$prodsAtt->product_color}}</td>
            <td>{{$prodsAtt->product_status}}</td>
            <td>{{$prodsAtt->product_name}}</td>
            <td>
            
            @if(!empty($prodsAtt->product_image))
            <img src="{{asset('/images/backend_images/products/small/'.$prodsAtt->product_image)}}" style="width: 123px;
    margin-left: 26px;">
            
            @endif

            @if(!empty($product->product_image))
            <img src="{{asset('/images/backend_images/products/small/'.$product->product_image)}}" style="width:250px;">
           
            @endif
            </td>

            <td>{{$prodsAtt->pincode}}</td>
          <td>
              <ul>
                  <li class="nav-item"style="    margin-top: 38px;">

<a class="btn btn-small btn-info text-dark ml-5"href="{{url('edit-product-attribute/'.$prodsAtt->id)}}" >edit </a>
</li>
<li style="    margin-left: 116px;
    margin-top: -42px;">

    <a class="btn btn-small btn-danger text-dark ml-5"href="{{url('delete-product-attribute/'.$prodsAtt->id)}}" >delete</a>
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