
@extends('layout')


@section('content')

<style>
  body{
          margin:0;
          padding:0;
          background-color:#ffefef;
      }
.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: 40%;
}
.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

.container {
  padding: 2px 16px;
}
</style>
<div class="left-sidbar">
  <form action="{{url('/products-filter/')}}" method="post">{{csrf_field()}}
  <input type="text" name="url"  id="" value="{{$catUrl}}">
  
    <div class="panel-group category-products">
    @if(!empty($_GET['color']))

<?php 
$colorArray=explode('-',$_GET['color']);
?>
@endif
    @foreach($colors as $color)
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a href="">
          <input name="colorFilter[]"   id="color" onchange='javascript:this.form.submit();' value="{{$color}}" type="checkbox" @if(!empty($colorArray)&&in_array($color,$colorArray)) checked="" @endif> {{$color}}
          </a>
        </h4>  
      </div>                                                                  
      </div>
    @endforeach
    
    </div>
  </form>
    </div>
@foreach($productsThisSubCats as $productThisCat)
<div class="card">
  <img src="img_avatar.png" alt="Avatar" style="width:100%">
  <div class="container">
    <h4><b>  <a href="/product/{{$productThisCat->id}}">{{$productThisCat->product_name}}</a></b></h4> 
    <p>{{$productThisCat->product_desc}}</p> 
    <p>{{$productThisCat->product_color}}</p> 
    <h5>  <a href="/view-similar-products/{{$productThisCat->product_url}}">similar this product</a></h5>
  </div>
</div>

@endforeach
</div>

@endsection