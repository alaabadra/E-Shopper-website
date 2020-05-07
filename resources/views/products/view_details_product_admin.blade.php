@extends('layout')
@section('content')
@if(empty($detailsThisProductCount))
<style>
         body{
        margin:0;
        padding:0;
        background-color:#ffefef;
    }
</style>
<h1 style="    margin-left: 352px;">
PAGE Details 
</h1>
        <div class="alert alert-info" role="alert">
        there is no any details for this product ,you can add it 
<a class="btn btn-small btn-info text-dark ml-5"href="{{url('/add-details-product/'.$prodId)}}" >add details into this product </a>

</div>
@else
<a class="btn btn-small btn-info text-dark ml-5"href="{{url('/add-details-product/'.$prodId)}}" >add details into this product </a>
<div class="widget-title"> <span><i class="icon-th"></i></span>
                    <h1 style="    margin-left: 590px;">view Details Product</h1>

<div class="widget-content nopadding">
<table id="table_id" class="table table-bordered data-table"style="    border: 4px solid #493641;
    margin-left: 95px;
    width: 88%;
    margin-top: 38px;
    border-radius: 15%;
">

    <thead>
        <tr>
            <th>Product Attribute  Id</th>
            <th>Product  Id</th>
            <th>Product Name</th>
            <th>Product Image</th>
            <th>Product Size</th>
            <th>Product Price</th>
            <th>Product Color</th>
      
            <th>Actions</th>
            
         
        </tr>
    </thead>
    <tbody>
@foreach($allProductsForThisProd as $product)

        <tr class="gradeX">

            <td>{{$product->id}}</td>
            <td>{{$product->product_id}}</td>
            <td>{{$product->product_name}}</td>
            <td>
            @if(!empty($product->product_image))
            <img src="{{asset('/images/backend_images/products/small/'.$product->product_image)}}" style="    width: 123px;
    margin-left: 149px;">
    
            @endif
            </td>
            <td>{{$product->product_size}}</td>
            <td>{{$product->product_price}}</td>
            <td>{{$product->product_color}}</td>
          <td>
          <ul style="list-style: none;    margin-left: -47px;
">
                  <li class="nav-item">

 
                     
                      <a class="btn btn-small btn-info text-dark ml-5"href="{{url('/edit-details-product/'.$product->id)}}" >edit </a>
                      <a class="btn btn-small btn-danger text-dark ml-5"href="{{url('/delete-details-product/'.$product->id)}}" >delete</a>
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
@endif
@endsection