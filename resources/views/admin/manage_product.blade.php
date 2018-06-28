@extends('admin.admin_master')
@section('admin-content')

<h1 class="text-center">Manage Products</h1>

@if(Session::has('message'))
  	<h3 class="alert alert-success  text-center">
		{{ session('message') }}
  	</h3>
@endif
<?php $i=1; ?> 		

      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-clock-o"></i> Manage your Products</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Price</th>
                  <th>Discounted Price</th>
                  <th>Feature Image</th>
                  <th>Category</th>
                  <th>Brands</th>                                              
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>No.</th>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Price</th>
                  <th>Discounted Price</th>
                  <th>Feature Image</th>               
                  <th>Category</th>
                  <th>Brands</th>               
                  <th>Action</th>
                </tr>
			  </tfoot>
			  <tbody>
				  @foreach($products as $product)
				<tr>
                  <td>{{ $i++ }}</td>
                  <td>{{ $product->title }}</td>
                  <td>{{ str_limit($product->description,20) }}</td>
                  <td>{{ $product->price }}</td>
				  <td class="text-center">{{ $product->discounted_price }}</td>
                  <td><img src="{{ asset('storage/'.$product->img_one) }}" width='50' height="50" alt="image" style="margin-left:35px"></td>
                  <td>{{ $product->category->category_name }}</td>
                  <td>{{ $product->brand->name }}</td>
				  	<td> 
						<a href="{{ route('edit-product',$product->id) }}" class="btn btn-warning">Edit</a> 
						<a href="{{ route('delete-product',$product->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a> 
					</td> 
				</tr>
				@endforeach
			  </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div>
@endsection