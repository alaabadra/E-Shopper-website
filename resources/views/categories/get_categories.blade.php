


@extends ("layout")
@section("content")
<div class="widget-content nopadding">
<table id="table_id" class="table table-bordered data-table">
    <thead>
        <tr>
            <th>cat id</th>
            <th>category Name</th>
            <th>category Image</th>
            <th>category Url</th>
      
            <th>Actions</th>
            
         
        </tr>
    </thead>
    <tbody>
@foreach($allCategories as $category)

        <tr class="gradeX">

            <td>{{$category->id}}</td>
            <td>{{$category->category_name}}</td>
            <td>{{$category->category_image}}</td>
            <td>{{$category->category_url}}</td>
          <td>
          
         <a target="_blank" href="{{url('edit-cat/'.$category->id)}}">view order details</a><br>
         <a target="_blank" href="{{url('delete-cat/'.$category->id)}}">view order invoice</a>
          </td>
 
        </tr>
    </tbody>
@endforeach


</div>
@endsection