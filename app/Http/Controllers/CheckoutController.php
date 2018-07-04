<?php

namespace App\Http\Controllers;

use App\Product;
use App\Brand;
use App\Category;
use App\User;
use App\Checkout;
use App\Payment;
use App\Order;
use App\Order_detail;

use Cart;
use Session;
use Auth;

use Illuminate\Http\Request;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Paypalpayment;
use App\Http\Middleware\RedirectIfAuthenticated;



class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // private $_api_context;
    // public function __construct()
    // {
    //     /** PayPal api context **/
    //     $paypal_conf = \Config::get('paypal');
    //     $this->_api_context = new ApiContext(new OAuthTokenCredential(
    //         $paypal_conf['client_id'],
    //         $paypal_conf['secret']
    //     ));
    //     $this->_api_context->setConfig($paypal_conf['settings']);
    // }
    // public function PayWithPaypal(Request $request)
    // {
    //     $all_item = Cart::content();
    //     $input = array_except($request->all() , array('_token'));
    //     $payer = new Payer();
    //     $payer->setPaymentMethod('paypal');
    //     $items= new Item();
    //     foreach ($all_item as $item) {
    //     $items->setName($item->name)
    //     /** item name **/
    //         ->setCurrency('USD')
    //         ->setQuantity($item->qty)
    //         ->setPrice($item->price);
    //     }
    //     /** unit price **/
    //     $item_list = new ItemList();
    //     $item_list->setItems($items);
    //     $amount = new Amount();
    //     $amount->setCurrency('USD')
    //         ->setTotal(Cart::total());
    //     $transaction = new Transaction();
    //     $transaction->setAmount($amount)
    //         ->setItemList($item_list)
    //         ->setDescription('Your transaction description');
    //     $redirect_urls = new RedirectUrls();
    //     $redirect_urls->setReturnUrl(route('checkout.status'))
    //     /** Specify return URL **/
    //         ->setCancelUrl(route('checkout.status'));
    //     $payment = new Payment();
    //     $payment->setIntent('Sale')
    //         ->setPayer($payer)
    //         ->setRedirectUrls($redirect_urls)
    //         ->setTransactions(array($transaction));
    //     /** dd($payment->create($this->_api_context));exit; **/
    //     try {
    //         $payment->create($this->_api_context);
    //     } catch (\PayPal\Exception\PPConnectionException $ex) {
    //         if (\Config::get('app.debug')) {
    //             \Session::put('error', 'Connection timeout');
    //             return Redirect::route('checkout.show');
    //         } else {
    //             \Session::put('error', 'Some error occur, sorry for inconvenient');
    //             return Redirect::route('checkout.show');
    //         }
    //     }
    //     foreach ($payment->getLinks() as $link) {
    //         if ($link->getRel() == 'approval_url') {
    //             $redirect_url = $link->getHref();
    //             break;
    //         }
    //     }
    //     /** add payment ID to session **/
    //     Session::put('paypal_payment_id', $payment->getId());
    //     if (isset($redirect_url)) {
    //         /** redirect to paypal **/
    //         return Redirect::away($redirect_url);
    //     }
    //     \Session::put('error', 'Unknown error occurred');
    //     return Redirect::route('checkout.show');
    // }
    // public function GetPaymentStatus()
    // {
    //     /** Get the payment ID before session clear **/
    //     $payment_id = Session::get('paypal_payment_id');
    //     /** clear the session payment ID **/
    //     Session::forget('paypal_payment_id');
    //     if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
    //         \Session::put('error', 'Payment failed');
    //         return Redirect::route('/');
    //     }
    //     $payment = Payment::get($payment_id, $this->_api_context);
    //     $execution = new PaymentExecution();
    //     $execution->setPayerId(Input::get('PayerID'));
    //     /**Execute the payment **/
    //     $result = $payment->execute($execution, $this->_api_context);
    //     if ($result->getState() == 'approved') {
    //         \Session::put('success', 'Payment success');
    //         return Redirect::route('/');
    //     }
    //     \Session::put('error', 'Payment failed');
    //     return Redirect::route('/');
    // }

    public function PayWithPaypal()
    {
        // // ### Address
        // // Base Address object used as shipping or billing
        // // address in a payment. [Optional]
        // $shippingAddress = Paypalpayment::shippingAddress();
        // $shippingAddress->setLine1("3909 Witmer Road")
        //     ->setLine2("Niagara Falls")
        //     ->setCity("Niagara Falls")
        //     ->setState("NY")
        //     ->setPostalCode("14305")
        //     ->setCountryCode("US")
        //     ->setPhone("716-298-1822")
        //     ->setRecipientName("Jhone");

        // // ### Payer
        // // A resource representing a Payer that funds a payment
        // // Use the List of `FundingInstrument` and the Payment Method
        // // as 'credit_card'
        // $payer = Paypalpayment::payer();
        // $payer->setPaymentMethod("paypal");

        // $all_item = Cart::content();
        // $i = 1;
        // foreach ($all_item as $item) {
        //     $i++;
        //     $i = Paypalpayment::item();            
        //     $i->setName($item->name)
        //         ->setCurrency('USD')
        //         ->setQuantity($item->qty)
        //         ->setTax(0)
        //         ->setPrice($item->price);
        //     $all = [$i];
        // }





        // $itemList = Paypalpayment::itemList();
        // $itemList->setItems($all)
        //     ->setShippingAddress($shippingAddress);


        // $details = Paypalpayment::details();
        // $details->setShipping("0")
        //     ->setTax("0")
        //         //total of items prices
        //     ->setSubtotal(Cart::subtotal());

        // //Payment Amount
        // $amount = Paypalpayment::amount();
        // $amount->setCurrency("USD")
        //         // the total is $17.8 = (16 + 0.6) * 1 ( of quantity) + 1.2 ( of Shipping).
        //     ->setTotal(Cart::total())
        //     ->setDetails($details);

        // // ### Transaction
        // // A transaction defines the contract of a
        // // payment - what is the payment for and who
        // // is fulfilling it. Transaction is created with
        // // a `Payee` and `Amount` types

        // $transaction = Paypalpayment::transaction();
        // $transaction->setAmount($amount)
        //     ->setItemList($itemList)
        //     ->setDescription("Payment description")
        //     ->setInvoiceNumber(uniqid());

        // // ### Payment
        // // A Payment Resource; create one using
        // // the above types and intent as 'sale'

        // $redirectUrls = Paypalpayment::redirectUrls();
        // $redirectUrls->setReturnUrl(url("/payments/success"))
        //     ->setCancelUrl(url("/payments/fails"));

        // $payment = Paypalpayment::payment();

        // $payment->setIntent("sale")
        //     ->setPayer($payer)
        //     ->setRedirectUrls($redirectUrls)
        //     ->setTransactions([$transaction]);

        // try {
        //     // ### Create Payment
        //     // Create a payment by posting to the APIService
        //     // using a valid ApiContext
        //     // The return object contains the status;
        //     $payment->create(Paypalpayment::apiContext());
        // } catch (\PPConnectionException $ex) {
        //     return response()->json(["error" => $ex->getMessage()], 400);
        // }

        // response()->json([$payment->toArray(), 'approval_url' => $payment->getApprovalLink()], 200);
        // return redirect(url($payment->getApprovalLink()));
        

    }

    public function UserUpdate(Request $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'zip_code' => $request->zip_code,
            'country' => $request->country,
            'city' => $request->city,
            'mobile_number' => $request->mobile_number,
            'fax_number' => $request->fax_number,
        ];
        $user = User::whereId($request->user_id)->update($data);
        // Session::put('user_id' , $request->user_id);
        return redirect(route('shipping'));
    }

    public function Shipping()
    {
        $data = [];
        $data['cart'] = Cart::content();
        return view('shipping',$data);
    }

    public function SaveShipping(Request $request)
    {
        $data = [
            'name' => $request->name,
            'company_name' => $request->company_name,
            'email_address' => $request->email_address,
            'address' => $request->address,
            'zip_code' => $request->zip_code,
            'city' => $request->city,
            'mobile_number' => $request->mobile_number,
            'phone_number' => $request->phone_number,
        ];
        $shipping = Checkout::create($data);
        Session::put('shipping_id', $shipping->id);
        return redirect(route('payment'));
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shipping_id = Session::get('shipping_id');
        $user_id = auth()->user()->id;
        $data = [];
        $data['cart'] = Cart::content();
        if($data['cart']->count() == 0){
            return redirect(route('index'));
        }
        if ($shipping_id && auth()->user()) {
            return view('payment', $data);
        } elseif ($shipping_id == null && auth()->user()) {
            return view('shipping', $data);
        }else{
        return view('checkout',$data);
        }
    }

    public function Payment()
    {
        $data = [];
        $data['cart'] = Cart::content();
        if ($data['cart']->count() == 0) {
            return redirect(route('index'));
        }
        return view('payment', $data);
    }

    public function PlaceOrder(Request $request)
    {
        $payment_data=[];
        $payment_data['payment_type'] = $request->payment_method;
        $payment_data['payment_status'] = 'Pending';
        $payment = Payment::create($payment_data);
        $payment_id = $payment->id;

        $order_data =[];
        $order_data['customer_id'] = auth()->user()->id; 
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = str_replace(',','',Cart::total());
        $order_data['order_status'] = "Pending";
        $order = Order::create($order_data);

        $order_details_data = [];
        foreach (Cart::content() as $product) {
            $order_details_data['order_id'] = $order->id;
            $order_details_data['product_id'] = $product->id;
            $order_details_data['product_name'] = $product->name;
            $order_details_data['product_price'] = $product->price;
            $order_details_data['product_sales_quantity'] = $product->qty;
            $order_detail = Order_detail::create($order_details_data);
        }
        

        if ($request->payment_method == 'cash_on_delivery') {
            Cart::destroy();
            return view('order_complete');
        }elseif($request->payment_method == 'ssl_commerz'){
            $this->ssl_commerz();
        }else {
            return view('paypal');            
        }
    }

    private function ssl_commerz(){

        
        define('STORE_ID', 'bikra5b3065e2300e3');
        define('STORE_PASSWORD', 'bikra5b3065e2300e3@ssl');
        define('SSLZC_REDIRECT_URL', 'https://sandbox.sslcommerz.com/gwprocess/v3/api.php');
        define('SSLZC_VALIDATION_API', 'https://sandbox.sslcommerz.com/validator/api/validationserverAPI.php');

        

        $post_data = [];
        $post_data['store_id'] = STORE_ID;
        $post_data['store_passwd'] = STORE_PASSWORD;
        $post_data['currency'] = 'BDT'; #$_POST['currency'];
        $post_data['total_amount'] = str_replace(',', '',Cart::total());
        $_SESSION['SSLCZ_TRX_ID'] = $post_data['tran_id'] = "SSLCZ_TEST_".uniqid();
        
        $post_data['success_url'] = route('payment.success');
        $post_data['fail_url'] = route('payment.fail');
        $post_data['cancel_url'] = route('payment.cancel');

        # Customer information 

        $_SESSION['CUS_HISTORY']['CUS_NAME'] = $post_data['cus_name'] = auth()->user()->name;
        $_SESSION['CUS_HISTORY']['CUS_EMAIL'] = $post_data['cus_email'] =  auth()->user()->email;
        $_SESSION['CUS_HISTORY']['CUS_ADD'] = $post_data['cus_add1']  = auth()->user()->address;
        $_SESSION['CUS_HISTORY']['CUS_COUNTRY'] = $post_data['cus_country']  = auth()->user()->country;

        # Shipment information




        #curl 
        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, SSLZC_REDIRECT_URL);
        curl_setopt($handle, CURLOPT_POST, 1);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);

        #only for localhost (2)
        curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, 0);

        $content = curl_exec($handle);
        $code = curl_getinfo($handle,CURLINFO_HTTP_CODE);

        if ($code ==200 && !(curl_errno($handle))) {
            curl_close($handle);
            $sslcommerzeResponse = $content;
            $sslcommerzeResponse = $content;

            $sslcz = json_decode($sslcommerzeResponse , true);  
            

            if (isset($sslcz['status']) && $sslcz['status'] == 'SUCCESS') {
                if (isset($sslcz['GatewayPageURL']) && $sslcz['GatewayPageURL'] != '' ) {
                    // echo '<meta http-equiv="refresh" concept="0; url=' .$sslcz['GatewayPageURL'].'" />';
                    echo '<meta http-equiv = "refresh" content = "0;URL=\''. $sslcz['GatewayPageURL'] .'\'" / >';
                    exit;
                }else{
                    echo "NO redirect url found";
                }
            } else {
                echo "Invalid credential";
            }
        } else {
            curl_close($handle);
            echo "Failed to connect with ssl commerze API";
            exit;
        }
        

    }

    public function Success()
    {
        Cart::destroy();
        return 'In Success';
    }
    public function Fail()
    {
       return 'Fail';
    }
    public function Cancel()
    {
        return 'Cancel';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function show(Checkout $checkout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function edit(Checkout $checkout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Checkout $checkout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function destroy(Checkout $checkout)
    {
        //
    }
}
