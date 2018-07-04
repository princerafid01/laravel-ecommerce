<html>
    <head>
<script>
    function paypal_submit() {
        var actionName = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
        document.forms.frmOrderAutoSubmit.action = actionName;
        document.forms.frmOrderAutoSubmit.submit();
    }
</script>
    </head>
<body onload="paypal_submit()">
    

<form action="" name="frmOrderAutoSubmit" method="POST">
    <input type="hidden" name="return" value="{{ url('/payments/success') }}">
    <input type="hidden" name="cancel_return" value="{{ url('/payment') }}">

    <input type="hidden" name="upload" value="1">
    <input type="hidden" name="cmd" value="_cart">
    <input type="hidden" name="business" value="amaketakadin@rafid.com">


 {{-- <input type="hidden" name="item_name_1" value="Item Name 1">
<input type="hidden" name="amount_1" value="1.00">
<input type="hidden" name="shipping_1" value="1.75">
<input type="hidden" name="item_name_2" value="Item Name 2">
<input type="hidden" name="amount_2" value="2.00">
<input type="hidden" name="shipping_2" value="2.50"> --}}

   
    <?php 
        $items = '';
        $i=1;
        foreach (Cart::content() as $item) {
  ?>

    <input type="hidden" name="item_name_{{ $i }}" value="{{ $item->name }}">
    <input type="hidden" name="amount_{{ $i }}" value="{{ $item->price }}">
    <input type="hidden" name="quantity_{{ $i }}" value="{{ $item->qty}}">
    
    <?php
    $i++;

}

    ?>

    {{-- <input type="hidden" name="rm" value="2">
    <input type="hidden" name="address_override" value="0"> --}}
    <input type="hidden" name="first_name" value="{{ auth()->user()->name }}">

    <input type="hidden" name="address1" value="">
    <input type="hidden" name="address2" value="">
    <input type="hidden" name="city" value="">
    <input type="hidden" name="name" value="">
    <input type="hidden" name="zip" value="">
    
</form>
</body>
</html>