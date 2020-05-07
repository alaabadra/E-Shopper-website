

@extends('layout')

@section('content')
<style>
  body{
        margin:0;
        padding:0;
        background-color:#ffefef;
    }
  .form-label{
    width: 24%;
    margin-left: 490px;
  }
  .form-control{
    width: 24%;
    margin-left: 490px;
    
  }
</style>
<h1 style="    margin-left: 589px;">Edit Banner Page</h1>

<form action="{{url('/edit-banner/'.$editBanner->id)}}" method="post"style="margin-top: 69px;
    margin-left: 122px;">{{csrf_field()}}

  <div class="form-group">
    <label for="banner_image"class="form-label">banner Image</label>
    <input name="banner_image" class="form-control" id="banner_image" placeholder="banner_image" value="{{$editBanner->banner_image}}">
  </div>
    <div class="form-group">
    <label for="banner_status"class="form-label" >banner Status</label>
    <select name="banner_status" id="" class="form-control">
        <option>0</option>
        <option>1</option>
 
    </select>
  </div>
  <button name="submit" class="btn btn-primary"style=" margin-left: 492px;
    width: 24%;">Edit</button>
          <div class="alert alert-danger" style="    color: #a94442;
    background-color: #f2dede;
    border-color: #ebccd1;
    width: 24%;
    margin-left: 493px;
    margin-top: 0px;">
        <ul>
          @if($errors->any())
          @foreach($errors->all() as $err)
            <li>{{$err}}</li>
          @endforeach
          </ul>
        </div>
        </form>
        @endif
</form>

@endsection