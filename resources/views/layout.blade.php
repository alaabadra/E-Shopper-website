<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
<link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">

<link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

<link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
<link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script> -->
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>


<script src="https://ajax.googleapis.com/ajax/libs/dojo/1.13.0/dojo/dojo.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
   <link rel="stylesheet" type="text/css" href="/DataTables/datatables.css">
   <script type="text/javascript" charset="utf8" src="/DataTables/datatables.js"></script>

   <script src="https://kit.fontawesome.com/a076d05399.js"></script>
   <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
      </script>
   <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
      </script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/main.css">

    <script src="js/main.js"></script>
    <title>Document</title>
</head>
<style>
/* .navbar-nav>li>a { */
.links {
  padding-top: 10px;
    padding-bottom: 10px;
    line-height: 20px;
    padding-left: 29px;
    border-radius: 3px;
    text-transform: uppercase;
    padding-left: 15px;
    padding-right: 10px;
    color: white;
}
.links.active,.links:hover{
  background:#1b9bff;
  transition:.5s;
}
.link-logout{
  padding-top: 10px;
    padding-bottom: 10px;
    line-height: 20px;
    padding-left: 29px;
    border-radius: 3px;
    text-transform: uppercase;
    padding-left: 15px;
    padding-right: 10px;
}
.link-logout.active,.link-logout:hover{
  background-color: rgb(225, 73, 79);

  transition:.5s;
}

.link-email{
  padding-top: 10px;
    padding-bottom: 10px;
    line-height: 20px;
    padding-left: 29px;
    border-radius: 3px;
    text-transform: uppercase;
    padding-left: 15px;
    padding-right: 10px;
    color:white;
}
.link-email.active,.link-email:hover{
  background-color: rgb(32, 203, 100);

  transition:.5s;
}




</style>
<body>
        
           

              <?php 
      use App\Category;
      use App\Coupon;
      use App\Cart;
      $getMainCats=Category::where(['parent_id'=>0])->get();

    $countUserCarts = Cart::where(['user_email'=>Session::get('sessionUser')])->count();
    $countUserFavs =  DB::table('my_fav')->where(['user_email'=>Session::get('sessionUser')])->count();
    // echo 'alaaaa'. $countUserCarts;
      
 
      ?>
     
          @if(Session::get('sessionUser'))

     <nav class="navbar navbar-expand-lg " style="
/* background-color: rgba(255, 76, 192, 0.75); */
    /* position: fixed; */
    /* background-color:  rgb(255, 0, 153); */
    top: 0px;
  /*  background-color:rgba(34, 24, 30, 0.68);*/
    background-color:#ff6aa5;

   /* background-color:#ff0099;*/
    width: 100%;"id="nav" style="width: 100%;">
    @elseif(Session::get('sessionAdmin')||Session::get('sessionsubAdmin'))
    <nav class="navbar navbar-expand-lg " style="
   background-color: #120f0feb;
    /* position: fixed; */
    top: 0px;
    /* margin-bottom: 77px; */
    width: 100%;"id="nav" style="width: 100%;">
    @else
    <nav class="navbar navbar-expand-lg " style="
   background-color: #ff6aa5;
    /* position: fixed; */
    top: 0px;
    /* margin-bottom: 77px; */
    width: 100%;"id="nav" style="width: 100%;">
    @endif
  <a class="navbar-brand" href='/home-page'>E-Shopper</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav" style="     margin-left: 66px;">
    <ul class="navbar-nav">
    <li class="nav-item active">
      </li>
      @foreach($getMainCats as $cat)    
              <li >
              <a class="links"  href="/get-sub-cats-for-users/{{$cat->id}}">{{$cat->category_name}}</a>
              </a>
              </li>
           @endforeach
            @if(Session::get('sessionUser'))
              
          
            <li><a class="links" href="{{url('/add-coupon/')}}"><i class="glyphicon glyphicon-plus "></i></span> add coupon</a></li>
          

            <li><a class="link-email" href="{{url('/view-profile/'.Session::get('sessionUser'))}}"><span class="glyphicon glyphicon-user" ></span> 
            <?php
          echo   Session::get('sessionUser');
            ?></a></li>
      
            <li><a class="links" href="{{url('/get-my-carts/'.Session::get('sessionUser'))}}"><i class="glyphicon glyphicon-shopping-cart" aria-hidden="true" ></i> <span style="color:blue">{{$countUserCarts}}</span> view  Cart</a></li>
            <li><a class="links" href="{{url('/view-my-favs')}}"><i class="glyphicon glyphicon-heart" aria-hidden="true" ></i> <span style="color:blue">{{$countUserFavs}}</span> view  favs</a></li>
            <li ><a class="link-logout" href="{{url('/logout-user')}}"><i class="glyphicon glyphicon-log-out" aria-hidden="true"></i> logout</a></li>

            @elseif(Session::get('sessionAdmin')||Session::get('sessionsubAdmin'))
      
      <?php Session::get('sessionAdmin');?>
        
        <li ><a class="links" href="{{url('/get-main-cats-for-admins')}}" >categories</a></li>
        <li ><a class="links" href="{{url('/admin/view-admins')}}" ><i class="glyphicon glyphicon-user" aria-hidden="true"></i> admins</a></li>
        <li ><a class="links" href="{{url('/view-coupons')}}"> coupons</a></li>
        <li><a class="links" href="{{url('/get-all-carts')}}" ><i class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></i> carts</a></li>
        <li ><a class="links" href="{{url('/view-cms')}}" > cms</a></li>
        <li ><a class="links" href="{{url('/admin/view-users')}}"><i class="glyphicon glyphicon-user" aria-hidden="true"></i> users</a> </li>
        <li ><a class="links" href="{{url('/view-products-attributes')}}" > attributes</a></li>
        <li ><a class="links" href="{{url('/view-banners')}}" > banners</a></li>
        <li ><a class="links" href="{{url('/logout-admin')}}" ><i class="glyphicon glyphicon-log-out" aria-hidden="true"></i> logout</a></li>
    @elseif(!Session::get('sessionUser'))

        <li ><a class="links" href="{{url('/login-user')}}"><i class="glyphicon glyphicon-log-in" aria-hidden="true" ></i> login</a></li>
        <li ><a class="links" href="{{url('/reg-user')}}"><i class="glyphicon glyphicon-log-in" aria-hidden="true"></i> register</a></li> 
    @elseif(!Session::get('sessionAdmin'))
        <li ><a class="links" href="{{url ('/login-admin')}}">login</a></li>
        <li ><a class="links" href="{{url ('/get-main-cats-for-admins')}}">view categories</a></li>
    @endif
    </ul>
  </div>
</nav>
<div class="scrollbar scrollbar-lady-lips">
  <div class="force-overflow"></div>
</div>
<!--  -->



    <!-- <form action="{{url('/products/filter')}}" method="post">{{csrf_field()}}
    @if(!empty($url))
      <input type="text" name="url" value="{{$product_name}}" id="" >
    <div class="left-sidbar">
    <div class="panel-group category-products">
      @if(!empty($_GET['color']))

        <?php 
        
        $colorArray=explode('-',$_GET['color']);
          echo "<pre>";print_r($colorArray);die;
        ?>
      @endif


  @foreach($colorArray as $color)
    @if(!empty($_GET['color']))
      <?php $colorArrInLink=explode('-',$_GET['color']); ?>
      @if(in_array($color,$colorArrInLink))
        <?php $colorcheck="checked"; ?>
      @else
        <?php $colorcheck=""; ?>
      @endif
    @else
      <?php $colorcheck=""; ?>
    @endif
      <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a href="">
          <input name="colorFilter[]" id="{{$color}}" onchange='javascript:this.form.submit();'value={{$color}} type="checkbox"{{$colorcheck}}>&nbsp;&nbsp; <span > {{$color}}</span>
          </a>
        </h4>  
      </div>
      </div>

      @endforeach

    </div>



    <h3>sleeve</h3>
    <div class="panel-group category-products">
      @if(!empty($_GET['color']))

        <?php 
        
        $colorArray=explode('-',$_GET['color']);
          //echo "<pre>";print_r($colorArray);die;
        ?>
      @endif


  @foreach($sleeveArray as $sleeve)
    @if(!empty($_GET['sleeve']))
      <?php $sleeveArrInLink=explode('-',$_GET['sleeve']); ?>
      @if(in_array($sleeve,$sleeveArrInLink))
        <?php $sleevecheck="checked"; ?>
      @else
        <?php $sleevecheck=""; ?>
      @endif
    @else
      <?php $sleevecheck=""; ?>
    @endif
      <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a href="">
          <input name="sleeveFilter[]" id="{{$sleeve}}" onchange='javascript:this.form.submit();'value={{$sleeve}} type="checkbox"{{$sleevecheck}}>&nbsp;&nbsp; <span > {{$sleeve}}</span>
          </a>
        </h4>  
      </div>
      </div>

      @endforeach

    </div>
    </div>
        @endif
    </form> -->
  

    
   @yield('content')
   @if(Session::has('flash_message_error'))
    <div class="alert alert-danger alert-block">
        <strong>{!!session('flash_message_error')!!}</strong>
    </div>
@endif

@if(Session::has('flash_message_success'))
    <div class="alert alert-success alert-block">
        <strong>{!!session('flash_message_success')!!}</strong>
    </div>
@endif

 <script>
  //  var nav=document.getElementById('nav');
  // window.onscroll=function(){
  //   if(window.pageYOffset>100){

  //   nav.style.position="fixed";
  //   nav.style.top=0;
  //   }else{
  //     box.style.position="absolute";
  //     box.style.top=100;
  //   }
  // }

 </script>
   <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5cc0837287f76545"></script>
   <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>