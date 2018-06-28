@extends('master')
@section('main_content')      
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Shipping</li>
            </ol>
        </div><!--/breadcrums-->



        {{-- <div class="register-req">
            <p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
        </div><!--/register-req--> --}}

        <div class="shopper-informations">
            <div class="row">
                <div class="col-sm-12 clearfix">
                    <div class="bill-to">
                        <h2 class="text-center">Shipping information</h2><br>
                        <div class="form-one">
                            <form action="{{ route('save.shipping') }}" method="POST">
                                {{ csrf_field() }}
                                <input type="text" name="name"  class="form-control" placeholder="Name" required>
                                <input type="text" name="company_name"  class="form-control" placeholder="Company Name" >
                                <input type="text" name="email_address"  class="form-control" placeholder="Email" required>
                                <input type="text" name="address" placeholder="Address  *" required>
                                <input type="text" name="zip_code"  placeholder="Zip / Postal Code *" required>
                                <br>
                                <input type="text" placeholder="City *" name="city">
                                <input type="text" name="mobile_number"  class="form-control" placeholder="Mobile Number" >
                                <input type="text" name="phone_number" placeholder="Phone Number *" required>
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