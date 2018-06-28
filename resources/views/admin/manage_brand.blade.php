@extends('admin.admin_master')
@section('admin-content')

<h1 class="text-center">Manage Brand</h1>

@if(Session::has('message'))
  	<h3 class="alert alert-success  text-center">
		{{ session('message') }}
  	</h3>
@endif
  		

<table class="table"> 
	<caption></caption>
	<thead> 
		<tr> 
			<th>#</th> 
			<th>Brand Name</th> 
			<th>Brand Photo</th> 
			<th>Action</th> 
		</tr> 
	</thead> 
	<tbody> 
		<?php 

			$i = 1;
		?>
			@foreach($brands as $brand)
		<tr> 
			<th scope="row">{{ $i++ }}</th> 
			<td>{{ $brand->name }}</td>  
 			<td><img src="{{ asset('storage/'.$brand->image_path) }}" alt="Brand Image" width="100"></td>
			<td> 
				<a href="{{ route('edit-brand' , $brand->id) }}" class="btn btn-warning">Edit</a> 
				<a href="{{ route('delete-brand' , $brand->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a> 
			</td> 

		</tr> 
			@endforeach
	</tbody> 
</table>
@endsection