@extends('layout')
@section('title')
    VIEW BANNERS Page
@endsection
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
                    <h1 style="    margin-left: 590px;">view products</h1>

                </div>
<div class="widget-content nopadding">
<table id="table_id" class="table table-bordered data-table"style="  border: 4px solid #493641;
    margin-left: 1px;
    width: 100%;
    margin-top: 38px;
    border-radius: 15%;
">

    <thead>
        <tr>
            <th>Product Id</th>
            <th>Product Name</th>
            <th>Product Status</th>
            <th>Product Image</th>
      
            <th>Actions</th>
            
         
        </tr>
    </thead>
    <tbody>
@foreach($productsThisSubCats as $product)

        <tr class="gradeX">

            <td>{{$product->id}}</td>
            <td>{{$product->product_name}}</td>
            @if($product->product_status==0)
                            <td> <a href="" class="btn btn-danger">Will Be Soon Come</a></td> 
                            @elseif($product->product_status==1)
                          <td> <a href="" class="btn btn-warning">Qualities in it  Will finish Soon</a></td> 
                            @elseif($product->product_status==2)
                        <td><a href="" class="btn btn-success">Qualities Exsit is Enough</a></td>    
                            @endif
            <td>
            @if(!empty($product->product_image))
            <img src="{{asset('/images/backend_images/products/small/'.$product->product_image)}}" style="    width: 123px;
    margin-left: 149px;">
             @else
            <img src="https://lh3.googleusercontent.com/proxy/pHOOPR3gEOodw8eUPwjxI6QPgaOgI_nfi0QHx04rwjd9CMInnbuF84heXiNDPlvBOY9J69ic12LmfC_DXZwRdB4N99ugpLZGtz189knY5xXfYIk-Bl74L_s" alt="">
            @endif
            </td>
          <td>
          <ul style="list-style: none;">
                  <li class="nav-item">

                      
                      <a class="btn btn-small btn-info text-dark ml-5"href="{{url('/add-details-product/'.$product->id)}}" >add details into this product </a>
                      <a class="btn btn-small btn-info text-dark ml-5"href="{{url('/view-details-product-for-admins/'.$product->id)}}" > view-details-product</a>
                     
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