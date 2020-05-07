
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

<h1  style="     margin-left: 514px;
    margin-bottom: 68px;">
 Add My Review into   {{$prodName}}
 </h1>
</div>
<form action="{{url('/add-my-review/'.$productAttr->id)}}" method="post"style="    width: 349px;
    margin-left: 594px;" >
{{csrf_field()}}
  <div class="form-group">
    <label for="review_desc">Review Description</label>
    <input type="review_desc" class="form-control" id="review_desc" placeholder="your description" name="review_desc">
  </div>
  <div class="form-group">
    <label for="nums_review">Rank Review</label>
    <select name="nums_review" id="" class="form-control">
        <option>0</option>
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
    </select>
  </div>
  <button type="submit" class="btn btn-primary"style="width:100%">Add</button>
  <div class="alert alert-danger" style="      color: #a94442;
    background-color: #f2dede;
    border-color: #ebccd1;
    width: 100%;
    margin-left: 1px;
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
