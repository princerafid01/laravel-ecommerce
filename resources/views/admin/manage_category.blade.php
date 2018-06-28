@extends('admin.admin_master')
@section('admin-content')

<h1 class="text-center">Manage Category</h1>

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
			<th>Category Name</th> 
			<th>Publication status</th> 
			<th>Action</th> 
			<th>Label</th> 
		</tr> 
	</thead> 
	<tbody> 
		<?php 

			$i = 1;
		?>
			@foreach($categories as $category)
		<tr> 
			<th scope="row">{{ $i++ }}</th> 
			<td>{{ $category->category_name }}</td>  
			<td {{($category->publication_status == 1) ? "":"style=color:red"}}>{{ ($category->publication_status == 1) ? "Published" : "Unpublished" }} </td> 
			<td> 
				@if($category->publication_status == 1)
				<a href="{{ route('unpublish-category',  $category->id) }}" class="btn btn-primary">Unpublish</a>
				@else 
				<a href="{{ route('publish-category' ,  $category->id) }}" class="btn btn-primary">Publish</a> 
				@endif
			</td>
			<td> 
				<a href="{{ route('edit-category' , $category->id) }}" class="btn btn-warning">Edit</a> 
				<a href="{{ route('delete-category' , $category->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a> 
			</td> 

		</tr> 
			@endforeach
	</tbody> 
</table>
@endsection