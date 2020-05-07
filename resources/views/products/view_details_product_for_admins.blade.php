@extends('layout')
@section('content')
<style>
         body{
        margin:0;
        padding:0;
        background-color:#ffefef;
    }
</style>
<a class="btn btn-small btn-info text-dark ml-5"href="{{url('/add-product')}}" >add product</a>
@if(empty($productsThisSubCatsCount))
        <div class="alert alert-info" role="alert">
        there is no products in cart, to add it you can add to cart a product
</div>
    @else
    <div class="widget-title"> <span><i class="icon-th"></i></span>
                    <h1 style="    margin-left: 590px;">view Details Product</h1>

                </div>
<div class="widget-content nopadding">
<table id="table_id" class="table table-bordered data-table"style="    border: 4px solid #493641;
    margin-left: 141px;
    width: 81%;
    margin-top: 38px;
    border-radius: 15%;
">

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
@foreach($productsThisSubCats as $product)

        <tr class="gradeX">

            <td>{{$product->id}}</td>
            <td>{{$product->product_name}}</td>
            <td>
            @if(!empty($product->product_image))
            <img src="{{asset('/images/backend_images/products/small/'.$product->product_image)}}" style="    width: 123px;
    margin-left: 149px;">
            @endif
            </td>
            <td>{{$product->product_url}}</td>
          <td>
          <ul style="list-style: none;">
                  <li class="nav-item">

                      
                      <a class="btn btn-small btn-info text-dark ml-5"href="{{url('/add-details-product/'.$product->id)}}" >add details into this product </a>
                      <a class="btn btn-small btn-info text-dark ml-5"href="{{url('/view-details-product-for-admin/'.$product->id)}}" > view-details-product</a>
                     
                      <a class="btn btn-small btn-info text-dark ml-5"href="{{url('/edit-product/'.$product->id)}}" >edit </a>
                      <a class="btn btn-small btn-danger text-dark ml-5"href="{{url('/delete-product/'.$product->id)}}" >delete</a>
                  </li>
              </ul>
          
          </td>
 
        </tr>
    </tbody>
@endforeach
@endif

                    </table>
                </div>



            </div>
        </div>
    </div>


</div>
@endsection