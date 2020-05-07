@extends('layout')

@section('content')


<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Au Register Forms by Colorlib</title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="page-wrapper bg-gra-01 p-t-180  font-poppins"style="margin-top: -24px;">
        <div class="wrapper wrapper--w780">
            <div class="card card-3">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">reg user</h2>
                    <form method="POST" name="registerForm" action="{{url('/reg-user')}}" autocomplete="off">
{{csrf_field()}}


<div class="input-group">
                            <input class="input--style-3" type="text" placeholder="email" name="email" >
                        </div>


                        <div class="input-group">
                            <input class="input--style-3" type="password" placeholder="password" name="password" >
                        </div>

                        <div class="input-group">
                            <input class="input--style-3" type="password" placeholder="reapeat password" name="password-repeat" >
                        </div>

                        <div class="input-group">
                            <input class="input--style-3" type="text" placeholder="name" name="name">
                        </div>

                        <div class="input-group">
                            <input class="input--style-3" type="text" placeholder="state" name="state">
                        </div>

                        <div class="input-group">
                            <input class="input--style-3" type="text" placeholder="pincode" name="pincode">
                        </div>

                        <div class="input-group">
                            <input class="input--style-3" type="text" placeholder="address" name="address">
                        </div>
                        <div class="input-group">
                            <input class="input--style-3" type="text" placeholder="city" name="city">
                        </div>
                        <div class="input-group">
                            <input class="input--style-3" type="text" placeholder="mobile" name="mobile">
                        </div>
               

                        <div class="input-group">
                        <select name="country_name" id="">
        <option value="0">country</option>
    @foreach($getCountries as $country)
        <option value="{{$country->id}}">{{$country->country_name}}</option> 
    @endforeach
      </select>
      <div class="p-t-10" style="margin-left: 56px;
    margin-bottom: 27px;    margin-top: 23px;">
                            <button class="btn btn--pill btn--green" type="submit">REGISTER</button>
                        </div>

      <span>if you login before time , you can login  <a href="/login-user">login user</a></span>

                        
                        </div>


            
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
@endsection
<!-- end document-->

