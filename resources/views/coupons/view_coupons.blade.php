@extends('layout')
@section('title')
    VIEW BANNERS Page
@endsection
@section('content')
<div class="widget-content nopadding">
<a class="btn btn-small btn-info text-dark ml-5"href="{{url('/admin/add-coupon')}}" >add coupon</a>


    
    <div class="container-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title"> <span><i class="icon-th"></i></span>
                    <h2  style="    margin-left: 590px;">view coupons</h2>
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
            <th>coupon_code</th>
            <th>amount</th>
            <th>amount_type</th>
            <th>expiry_date</th>
            <th>status</th>
      
            <th>actions</th>
            
         
        </tr>
    </thead>
    <tbody>
@foreach($coupons as $coupon)

        <tr class="gradeX">

            <td>{{$coupon->coupon_code}}</td>
            <td>{{$coupon->amount}}</td>
            <td>{{$coupon->amount_type}}</td>
            <td>{{$coupon->expiry_date}}</td>
            <td>{{$coupon->status}}</td>
          <td>
          <ul>
                  <li class="nav-item">

                      <a class="btn btn-small btn-info text-dark ml-5"href="{{url('edit-coupon/'.$coupon->id)}}" >edit </a>
                      <a class="btn btn-small btn-danger text-dark ml-5"href="{{url('delete-coupon/'.$coupon->id)}}" >delete</a>
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