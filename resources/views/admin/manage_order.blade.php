@extends('admin.admin_master')
@section('admin-content')

<h1 class="text-center">Manage Orders</h1>

@if(Session::has('message'))
  	<h3 class="alert alert-success  text-center">
		{{ session('message') }}
  	</h3>
@endif


      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-clock-o"></i> Manage your Orders</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Order id.</th>
                  <th>Customer Name</th>
                  <th>Order Total</th>
                  <th>Order status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Order id.</th>
                  <th>Customer Name</th>
                  <th>Order Total</th>
                  <th>Order status</th>
                  <th>Actions</th>
                </tr>
			  </tfoot>
			  <tbody>
				  @foreach($orders as $order)
				<tr>
                  <td>{{ $order->id }}</td>
                  <td>{{ App\User::find($order->id)->name }}</td>
                  <td>{{ $order->order_total }}</td>
                  <td>{{ $order->order_status }}</td>
				  	<td> 
						<a href="{{ route('admin.view.order',$order->id) }}" class="btn btn-warning">View</a> 
						<a href="{{ route('admin.delete.order',$order->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a> 
					</td> 
				</tr>
				@endforeach
			  </tbody>
            </table>
          </div>
        </div>
        
      </div>
@endsection