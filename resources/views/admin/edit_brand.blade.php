@extends('admin.admin_master')
@section('admin-content')
<h1 class="text-center">Edit Brand</h1>

    @if(Session::has('message'))
        <h3 style="font-family: cursive" class="alert alert-success  text-center">
            {{ session('message') }}
        </h3>
    @endif

{{-- {{ Form::open(['class' => "form-horizontal" , 'url' => '/save-category']) }} --}}
<form class="form-horizontal" action="{{ route('edit-brand.submit' , $brand->id) }}" method="POST" enctype="multipart/form-data">
  {{ csrf_field() }}
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Edit Brand Name</label>
    <div class="col-sm-10">
      <input type="text" name="name" class="form-control" id="inputEmail3" value="{{ $brand->name }}">
    </div>
  </div>
    <div class="form-group">
    <div class="file-tab panel-body">
      <label for="" class="btn btn-default">
        <input type="file" name="image_path">
      </label>
    </div>
  </div>
  <img src="{{ asset('storage/'.$brand->image_path) }}" alt="Brand Image">




  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Edit Brand</button>
    </div>
  </div>
  {{-- {{ Form::close() }} --}}
</form>
@endsection