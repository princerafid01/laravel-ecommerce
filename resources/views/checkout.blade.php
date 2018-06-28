@extends('master')
@section('main_content')      
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Check out</li>
            </ol>
        </div><!--/breadcrums-->



        {{-- <div class="register-req">
            <p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
        </div><!--/register-req--> --}}

        <div class="shopper-informations">
            <div class="row">
                <div class="col-sm-12 clearfix">
                    <div class="bill-to">
                        <h2 class="text-center">Your Personal information</h2><br>
                        <div class="form-one">
                            <form action="{{ route('user.update') }}" method="POST">
                                {{ csrf_field() }}
                                <input type="text" name="name"  class="form-control" value="{{ auth()->user()->name }}" >
                                <input type="text" name="email"  class="form-control" value="{{ auth()->user()->email }}" >
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                <input type="text" name="address" placeholder="Address  *" required>
                                <input type="text" name="zip_code"  placeholder="Zip / Postal Code *" required>
                                <select name="country" required>
                                    <option value="">-- Country --</option>
                                    <option value="United States">United States</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                    <option value="UK">UK</option>
                                    <option value="India">India</option>
                                    <option value="Pakistan">Pakistan</option>
                                    <option value="Ucrane">Ucrane</option>
                                    <option value="Canada">Canada</option>
                                    <option value="Dubai">Dubai</option>
                                </select>
                                <br>
                                <br>
                                <input type="text" placeholder="City *" name="city">
                                <input type="text" name="mobile_number"  class="form-control" value="{{ auth()->user()->mobile_number }}" >
                                <input type="text" name="fax_number" placeholder="Fax *" required>
                                <button type="submit" class="btn btn-warning">Save & Next</button>
                            </form>
                        </div>
                    </div>
                </div>					
            </div>
        </div>










    </div>
</section> <!--/#cart_items-->

@endsection