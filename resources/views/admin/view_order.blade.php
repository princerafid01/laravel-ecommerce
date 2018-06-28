@extends('admin.admin_master')
@section('admin-content')

<h1 class="text-center">Invoice</h1>

<h4 class="text-left">Order #{{ $order->id }} - {{ date('Y / m / d', strtotime($order->created_at)) }}</h4>
<h4 class="text-right">Order status: {{ $order->order_status }}</h4>
<div class="clearfix"></div>

@if(Session::has('message'))
  	<h3 class="alert alert-success  text-center">
		{{ session('message') }}
  	</h3>
@endif

<br>
<br>

<div class="container">
  <div class="row">
    <div class="col-md-6">
      <h5>Billing Address</h5>
      <p>{{ $customer->name }}</p>
      <p>{{ $customer->address }}</p>
      <p><strong>Email: </strong>{{ $customer->email }}</p>
      <p><strong>Mobile: </strong> 0{{ $customer->mobile_number }}</p>
    </div>
    <div class="col-md-6">
      <h5>Shipping Address</h5>
      <p>{{ $shipping->name }}</p>
      <p>{{  $shipping->address  }}</p>
    </div>
  </div>
</div>

<div class="container">
  <table class="table table-hover table-bordered">
    <thead>
      <tr>
        <th>No.</th>
        <th>Product</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Total </th>
      </tr>
    </thead>
    <tbody>
      <?php $i = 1; ?>
      @foreach($order->order_details as  $order_detail)
      <tr>
        <td>{{ $i++ }}</td>
        <td>{{ $order_detail->product_name }}</td>
        <td>{{ $order_detail->product_sales_quantity }}</td>
        <td>{{ $order_detail->product_price }}</td>
        <td>{{ $order_detail->product_price * $order_detail->product_sales_quantity }}</td>
      </tr>
      @endforeach
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <th>Subtotal:</th>
        <td>{{ $order->order_total }}</td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <th>Tax:</th>
        <td>0.00</td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <th>Shipping:</th>
        <td>0.00</td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td></td>
      <th>Total:</th>
        <td>{{ $order->order_total }}</td>
      </tr>
    </tbody>
  </table>
</div>
<style>
  .text-left {float: left}
  .text-right {
    float: right;
}
</style>

@endsection