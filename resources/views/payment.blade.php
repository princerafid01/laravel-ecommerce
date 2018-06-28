@extends('master')
@section('main_content')  
<div class="container">
    <div class="row">
        <div class="col-md-12">


 <div class="review-payment">
            <h2>Review & Payment</h2>
        </div>

        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description">Description</td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $item)
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="{{ asset('storage/'.$item->options['image']) }}" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$item->name}}</a></h4>
                            <p>Web ID: {{$item->id}}</p>
                        </td>
                        <td class="cart_price">
                            <p>${{$item->price}}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                
                            <p>{{ $item->qty }}</p>
                                
                            </div>

                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">${{$item->subtotal}}</p>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="total_area">
                <ul>
                    <li>Cart Sub Total <span>${{ Cart::subtotal() }}</span></li>
                    <li>Eco Tax <span>${{ Cart::tax() }}</span></li>
                    <li>Shipping Cost <span>Free</span></li>
                    <li>Total <span>${{Cart::total()}}</span></li>
                </ul>
            </div>
        </div>
        <div class="payment-options">
            <form action="{{ route('place.order') }}" method="POST" class="form-group">
            {{ csrf_field() }}
            <span>
                <label><input   type="radio" name="payment_method" value="cash_on_delivery"> Cash on delivery</label>
            </span>
            <span>
                <label><input   type="radio" name="payment_method" value="ssl_commerz">  SSLcommerz</label>
            </span>
            <span>
                <label><input   type="radio" name="payment_method" value="paypal"> Paypal</label>
            </span>
            <button type="submit" class="btn btn-warning ">Place Order</button>
            </form>
        </div>
       </div>
    </div>
</div>  
@endsection