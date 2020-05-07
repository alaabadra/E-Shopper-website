 
  @extends('layout')
@section('title')
    EDIT PARENT CATEGORY Page
@endsection
@section('content')
<style>
  .form-label{
    width: 24%;
    margin-left: 490px;
  }
  .form-control{
    width: 24%;
    margin-left: 490px;
    
  }
</style>
<h1 style="    margin-left: 589px;">Add  sub Category into ({{$categoryName}}) </h1>

<form action="{{url('/add-sub-category/'.$categoryId)}}" method="post"style="margin-top: 69px;
    margin-left: 122px;"enctype="multipart/form-data">{{csrf_field()}}



  <div class="form-group">
    <label for="category_name"class="form-label">category Name</label>
    <input type="text" name="category_name" id="" class="form-control">
  

  </div>
  <div class="form-group">
    <label for="category_image"class="form-label">category Image</label>
    <input name="category_image" class="form-control" id="category_image" placeholder="category_image" type="file">
  </div>

  <div class="form-group">
    <label for="category_url"class="form-label">category Url</label>
    <select name="category_url" id="" class="form-control">
    @foreach($MainCats as $MainCat)
    <option value="{{$MainCat->id}}">{{$MainCat->category_name}}</option>

    @endforeach
    </select>
  </div>

  <div class="form-group">
    <label for="status"class="form-label" >status</label>
    <select name="status" id="" class="form-control">
        <option>0</option>
        <option>1</option>
        <option>2</option>
 
    </select>
  </div>



  <button name="submit" class="btn btn-primary"style="     margin-left: 492px;
    width: 24%;">ADD</button>
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
          @endif
          </ul>
        </div>
</form>

@endsection