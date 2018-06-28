@extends('master')
@section('main_content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{ route('index') }}">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            @if(count($cart))
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
                                <form method="POST" action="{{ route('cart.update') }}">
                                    {{ csrf_field() }}                                    
                                <a class="cart_quantity_up" href='{{ route('cart.update.increase', [$item->rowId , $item->qty]) }}'> + </a>


                                <input class="cart_quantity_input" type="text" name="qty" value="{{$item->qty}}" autocomplete="off" size="2">
                                <input type="hidden" name="rowId" value="{{ $item->rowId}}">
                                <input type="submit" value="Update">

                                
                                <a class="cart_quantity_down" href='{{ route('cart.update.decrease', [$item->rowId , $item->qty]) }}'> - </a>
                                </form>
                            </div>

                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">${{$item->subtotal}}</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="{{ route('cart.delete',$item->rowId) }}" onclick="return confirm('Are you sure?')"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    @else
                <span>You have no items in the shopping cart</span>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->
@if(count($cart))
<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>What would you like to do next?</h3>
            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="chose_area">
                    <ul class="user_option">
                        <li>
                            <input type="checkbox">
                            <label>Use Coupon Code</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Use Gift Voucher</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Estimate Shipping & Taxes</label>
                        </li>
                    </ul>
                    <ul class="user_info">
                        <li class="single_field">
                            <label>Country:</label>
                            <select>
                                <option>United States</option>
                                <option>Bangladesh</option>
                                <option>UK</option>
                                <option>India</option>
                                <option>Pakistan</option>
                                <option>Ucrane</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>

                        </li>
                        <li class="single_field">
                            <label>Region / State:</label>
                            <select>
                                <option>Select</option>
                                <option>Dhaka</option>
                                <option>London</option>
                                <option>Dillih</option>
                                <option>Lahore</option>
                                <option>Alaska</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>

                        </li>
                        <li class="single_field zip-field">
                            <label>Zip Code:</label>
                            <input type="text">
                        </li>
                    </ul>
                    <a class="btn btn-default update" href="">Get Quotes</a>
                    <a class="btn btn-default check_out" href="">Continue</a>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Cart Sub Total <span>${{ Cart::subtotal() }}</span></li>
                        <li>Eco Tax <span>${{ Cart::tax() }}</span></li>
                        <li>Shipping Cost <span>Free</span></li>
                        <li>Total <span>${{Cart::total()}}</span></li>
                    </ul>
                    <a class="btn btn-default update" href="{{ route('clear-cart')}}" onclick="return confirm('Are you sure to remove all product?')">Clear Cart</a>
                    <a class="btn btn-default check_out" href="{{ route('checkout.show')}}">Check Out</a>
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->
@endif
@endsection