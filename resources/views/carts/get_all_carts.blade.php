@extends('layout')
@section('title')
    VIEW BANNERS Page
@endsection
@section('content')
<a class="btn btn-small btn-info text-dark ml-5"href="{{url('/admin/add-cart')}}" >add cart</a>
@if(empty($getAllCarts))
        <div class="alert alert-info" role="alert">
        there is no products in cart, to add it you can add to cart a product
</div>
    @else


<div class="container-fluid">
    <div class="span12">
      
        <div class="widget-title"> <span><i class="icon-th"></i></span>
                        <h2  style="    margin-left: 590px;">view all carts</h2>
                    </div>
                <div class="widget-content nopadding">
                    <table class="table table-bordered data-table"style="    border: 4px solid #493641;
    margin-left: 47px;
    width: 93%;
    margin-top: 38px;
    border-radius: 15%;
">
                    
                       
<thead>
        <tr>
            <th>cat id</th>
            <th>product Name</th>
            <th>product Size</th>
            <th>product Price</th>
            <th>user Email</th>
      
            <th>actions</th>
            
         
        </tr>
    </thead>
    <tbody>
@foreach($getAllCarts as $cart)

        <tr class="gradeX">

            <td>{{$cart->id}}</td>
            <td>{{$cart->product_name}}</td>
            <td>{{$cart->product_size}}</td>
            <td>{{$cart->product_price}}</td>
            <td>{{$cart->user_email}}</td>
          <td>
     

         <ul>
                  <li class="nav-item">

                      <a class="btn btn-small btn-info text-dark ml-5"href="{{url('/get-cart/'.$cart->id)}}" >view </a>
                      <a class="btn btn-small btn-info text-dark ml-5"href="{{url('edit-cart/'.$cart->id)}}" >edit </a>
                      <a class="btn btn-small btn-danger text-dark ml-5"href="{{url('delete-cart/'.$cart->id)}}" >delete</a>
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