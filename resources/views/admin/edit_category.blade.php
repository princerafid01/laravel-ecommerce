@extends('admin.admin_master')
@section('admin-content')
<h1 class="text-center">Edit Category</h1>

    @if(Session::has('message'))
        <h3 style="font-family: cursive" class="alert alert-success  text-center">
            {{ session('message') }}
        </h3>
    @endif

{{-- {{ Form::open(['class' => "form-horizontal" , 'url' => '/save-category']) }} --}}
<form class="form-horizontal" action="{{ route('edit-category.submit' , $category->id) }}" method="POST">
  {{ csrf_field() }}
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Edit Category Name</label>
    <div class="col-sm-10">
      <input type="text" name="category_name" class="form-control" id="inputEmail3" value="{{ $category->category_name }}">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Category Description</label>
    <div class="col-sm-10">
    	<textarea name="category_description" class="form-control" id="" cols="30" rows="5"> {{ $category->category_description }}</textarea>
      {{-- <input type="password" class="form-control" id="inputPassword3" placeholder="Password"> --}}
    </div>
  </div>

  <div class="form-group">
  	<label for="inputPassword3" class="col-sm-2 control-label">Publiction status</label>
    <div class="col-sm-10">
    	<select class="form-control" name="publication_status" id="">
    		<option value="">Select Publiction Status</option>
    		<option value="0" {{ ($category->publication_status == 0) ? 'selected' : '' }}>Unpublished</option>
    		<option value="1" {{ ($category->publication_status == 1) ? 'selected' : '' }}>Published</option>
    	</select>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Edit category</button>
    </div>
  </div>
  {{-- {{ Form::close() }} --}}
</form>
@endsection