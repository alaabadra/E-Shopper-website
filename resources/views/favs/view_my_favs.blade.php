
@extends('layout')
@section('content')
    <style>
          body{
        margin:0;
        padding:0;
        background-color:#ffefef;
    }
      .card-title {
        font-weight: 300;
        font-size: 2rem;
    }
    .product-card .card {
        margin: 20px;
        overflow: hidden;
    }
    .product-card .card .card-content {
        padding: 5px;
    }
    .product-card .card .price {
        width: 70px;
        height: 70px;
        font-weight: 600;
        font-size: 1.45rem;
        line-height: 70px;
        margin: 10px;
        position: absolute;
        top: 0;
        letter-spacing: 0;
    }
    .product-card ul.card-action-buttons {
        margin: -18px 7px 0 0;
        text-align: right;
    }
    .product-card ul.card-action-buttons li {
        display: inline-block;
        padding-left: 7px;
    }
    .product {
        width: 20%;
        padding: 10px;
    }
    .product .card {
        margin: 0;
    }
    .product .card .card-content {
        padding: 5px 10px;
    }
    
    a {
  -webkit-transition: .25s all;
  transition: .25s all;
}

.card {
  overflow: hidden;
  box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
  -webkit-transition: .25s box-shadow;
  transition: .25s box-shadow;
}

.card:focus,
.card:hover {
  box-shadow: 0 5px 11px 0 rgba(0, 0, 0, 0.18), 0 4px 15px 0 rgba(0, 0, 0, 0.15);
}

.card-inverse .card-img-overlay {
  background-color: rgba(51, 51, 51, 0.85);
  border-color: rgba(51, 51, 51, 0.85);
}
.header{
  margin-top: 43px;
    font-family: fantasy;
}
.header:hover{
  color:#ff00bc;
}
    </style>

<div class="header">
            
            <h1 style="     margin-top: -16px;
    margin-left: 641px;
    margin-bottom: 53px;">Your List Favourit</h1>
        </div>
        
@if(empty($favs))
<div class="alert alert-info" role="alert" style="margin-left: 70px;
    width: 40%;">
    there is no any products in your favs  now , so you must add product into your fav
</div>
@else

    <div class="Container-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title"><span class="icon"><i class="icon-th"></i></span>
                
                </div>

    <div class="widget-content nopadding">
    <table id="table_id" class="table table-bordered  table-striped"style="    border: 4px solid #493641;
    margin-left: 298px;
    width: 64%;
    margin-top: 38px;
    border-radius: 15%;
">
        <thead>
            <tr>
                <th>Product Id</th>
                <th>Product Name</th>  
                <th>Product Size</th>
                <th>Product Price</th>     
               
                <th>Actions</th>
                
             
            </tr>
        </thead>
        <tbody>
         
    @foreach($favs as $fav)
            <tr class="gradeX">
    
                <td>{{$fav->product_id}}</td>
                <td>{{$fav->product_name}}</td>
                <!-- <td>{{$fav->user_email}}</td> -->
                <td>{{$fav->size}}</td>
                <td>{{$fav->price}}</td>
               
              <td>
              
             <!-- <a  href="{{url('/delete-from-my-fav/'.$fav->id)}}" class="btn btn-danger">delete product</a> -->
             <a   class="btn btn-danger deleteRecorder" rel="{{$fav->id}}" rel1="delete-from-my-fav">delete product</a>
              </td>
     
            </tr>
        </tbody>
    @endforeach
    
    </div>


@endif   
            </div>
        
        </div>
    </div>

     
 <script>

 $(".deleteRecorder").click(function(){
  var id=$(this).attr('rel');
  var deleteFun=$(this).attr('rel1');
  //alert(deleteFun);
  swal({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  type:"warning",
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  confirmButtonClass: 'btn-dange',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
},
  function(){
    window.location.href=deleteFun+"/"+id;
  });

});

 </script>   
   

@endsection