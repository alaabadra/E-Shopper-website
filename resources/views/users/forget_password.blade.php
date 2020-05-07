
@extends('layout')

@section('content')
<style>
         body{
        margin:0;
        padding:0;
        background-color:#ffefef;
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

<h1 style="     margin-left: 605px;
    margin-top: 24px;">Reset Password</h1>
</div>

  <div class="container">
<form  method="POST"  action="{{url('/forget-password')}}"style="margin-left: 378px;
    margin-top: 61px;">
{{csrf_field()}}
  <div class="imgcontainer">
  </div>


  <label for="email"><b>Email</b></label>
    <input type="email" placeholder="Enter Email" name="email" required class="form-control" style="    width: 41%;
    margin-bottom: 17px;">
 <button type="submit" class="btn btn-info" style=" 
     margin-left: 103px;">Go</button>
  </div>

</form>
@endsection