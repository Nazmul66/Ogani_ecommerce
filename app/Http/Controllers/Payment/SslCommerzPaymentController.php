<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Division;
use App\Models\Country;
use App\Models\District;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMail;

class SslCommerzPaymentController extends Controller
{

    public function checkoutPage()
    {
        if( Auth::check() ){
            $carts      = Cart::where('user_id', Auth::user()->id)->where('order_id', NULL)->get();
            $users      = User::where('id', Auth::user()->id)->first();
            $divisions  = Division::orderBy('id', 'ASC')->get();
            $districts  = District::orderBy('id', 'ASC')->get();
            $countries  = Country::orderBy('id', 'ASC')->get();
            return view('frontend.pages.cart.checkout', compact('carts', 'users', 'divisions', 'districts', 'countries'));
        }
        else{
            $notifications = [
                "message"    => "At first please login your account",
                'alert-type' => "warning",
            ];

           return redirect()->route('login')->with($notifications);
        }
    }


    public function index(Request $request)
    {

        # Here you have to receive all the order data to initate the payment.
        # Let's say, your oder transaction informations are saving in a table called "orders"
        # In "orders" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount'] = $request->total; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION  
        $post_data['user_id']            = Auth::id();
        $post_data['cus_name']           = $request->c_name;
        $post_data['cus_email']          = $request->c_email;
        $post_data['cus_add1']           = $request->c_address;
        $post_data['cus_add2']           = $request->c_address_optional;
        $post_data['cus_phone']          = $request->c_phone;
        $post_data['cus_phone2']         = $request->c_phone_optional;
        $post_data['cus_city']           = $request->c_city;
        $post_data['cus_district']       = $request->c_district;
        $post_data['cus_division']       = $request->c_division;
        $post_data['cus_postcode']       = $request->c_zipCode;
        $post_data['subtotal']           = $request->subtotal;
        $post_data['payment_type']       = $request->payment_type;
        $post_data['tax']                = $request->tax;
        $post_data['shipping_charge']    = "0";
        $post_data['date']               = date('Y-m-d');
        $post_data['month']              = date('F');
        $post_data['year']               = date('Y');
        
        if(Session::has('coupon')){
            $post_data['coupon_code']         = Session::get('coupon')['coupon_name'];
            $post_data['coupon_discount']     = Session::get('coupon')['coupon_discount'];
            $post_data['after_discount']      = $post_data['subtotal'] - Session::get('coupon')['coupon_discount'];
        }
        else{
            $post_data['coupon_code']         = null;
            $post_data['coupon_discount']     = null;
            $post_data['after_discount']      = $post_data['subtotal'];
        }

        # SHIPMENT INFORMATION
        $post_data['ship_name']               = "Store Test";
        $post_data['ship_add1']               = "Dhaka";
        $post_data['ship_add2']               = "Dhaka";
        $post_data['ship_city']               = "Dhaka";
        $post_data['ship_state']              = "Dhaka";
        $post_data['ship_postcode']           = "1000";
        $post_data['ship_phone']              = "";
        $post_data['ship_country']            = "Bangladesh";

        $post_data['shipping_method']         = "NO";
        $post_data['product_name']            = "Computer";
        $post_data['product_category']        = "Goods";
        $post_data['product_profile']         = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a']                 = "ref001";
        $post_data['value_b']                 = "ref002";
        $post_data['value_c']                 = "ref003";
        $post_data['value_d']                 = "ref004";

         // for ssl commercz payments
        if( $request->payment_type === 'ssl_Commerze' ){
            #Before  going to initiate the payment order status need to insert or update as Pending.
            $update_product = DB::table('orders')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'user_id'              => $post_data['user_id'],
                'c_name'               => $post_data['cus_name'],
                'c_email'              => $post_data['cus_email'],
                'c_address'            => $post_data['cus_add1'],
                'c_address_optional'   => $post_data['cus_add2'],
                'c_zipCode'            => $post_data['cus_postcode'],
                'c_phone'              => $post_data['cus_phone'],
                'c_phone_optional'     => $post_data['cus_phone2'],
                'subtotal'             => $post_data['subtotal'],
                'coupon_code'          => $post_data['coupon_code'],
                'coupon_discount'      => $post_data['coupon_discount'],
                'after_discount'       => $post_data['after_discount'],
                'payment_type'         => $post_data['payment_type'],
                'tax'                  => $post_data['tax'],
                'shipping_charge'      => $post_data['shipping_charge'],
                'transaction_id'       => $post_data['tran_id'],
                'status'               => 0,
                'total'                => $post_data['total_amount'],
                'date'                 => $post_data['date'],
                'month'                => $post_data['month'],
                'year'                 => $post_data['year'],
                // 'currency'          => $post_data['currency']
            ]);

            $transaction_Id = $post_data['tran_id'];
            // clear all cart items
            $order_id = Order::where('transaction_id', $transaction_Id)->first();

            foreach( Cart::where('user_id', Auth::id())->where('order_id', NULL)->get() as $cart ){
                // cart deduce quantity stock
                $product = Product::where('id', $cart->product_id)->first();
                $upQty   = $product->quantity_stock - $cart->product_qty;
                $product->quantity_stock = $upQty;
                $product->save();
                
                $cart->order_id = $order_id->id;
                $cart->save();
            }

            // session destroy for coupons after purchase
            if (Session::has('coupon')) {
                 Session::forget('coupon'); 
            }

            // sending mail information
            $mailData = [
                'name'     => $request->c_name,
                'address'  => $request->c_address,
                'mail'     => $request->c_email,
            ];

            $customerMails = ['nh4647352@gmail.com', $request->c_email];

            foreach( $customerMails as $customerMail ){
                 Mail::to($customerMail)->send(new InvoiceMail($mailData));
            }
        }

        // for hand cash payments
        else if( $request->payment_type === 'hand_cash' ){

            $order = new Order();

            $transaction_id             = hexdec(rand(10000, 9999999999));
            $order->user_id             = Auth::id();
            $order->c_name              = $request->c_name;
            $order->c_city              = $request->c_city;
         //    $order->c_division          = $request->c_division;
         //    $order->c_district          = $request->c_district;
            $order->c_address           = $request->c_address;
            $order->c_address_optional  = $request->c_address_optional;
            $order->c_zipCode           = $request->c_zipCode;
            $order->c_phone             = $request->c_phone;
            $order->c_phone_optional    = $request->c_phone_optional;
            $order->c_email             = $request->c_email;
            $order->payment_type        = $request->payment_type;
            $order->tax                 = $request->tax;
             if(Session::has('coupon')){
                     $order->subtotal            = $request->subtotal;
                     $order->coupon_code         = Session::get('coupon')['coupon_name'];
                     $order->coupon_discount     = Session::get('coupon')['coupon_discount'];
                     $order->after_discount      = $request->subtotal - Session::get('coupon')['coupon_discount'];
                     $order->total               = $request->subtotal - Session::get('coupon')['coupon_discount'] + $request->tax;
             }
             else{
                     $order->subtotal            = $request->subtotal;
                     $order->total               = $request->subtotal + $request->tax;
             }
            $order->shipping_charge     = 0;
            $order->transaction_id      = $transaction_id;
            $order->status              = 0;
            $order->date                = date('Y-m-d');
            $order->month               = date('F');
            $order->year                = date('Y');
 
            
            $order->save();
            
            // clear all cart items
            $order_id = Order::where('transaction_id', $transaction_id)->first();
 
            foreach( Cart::where('user_id', Auth::id())->where('order_id', NULL)->get() as $cart ){
                
                // cart deduce quantity stock
                $product = Product::where('id', $cart->product_id)->first();
                $upQty   = $product->quantity_stock - $cart->product_qty;
                $product->quantity_stock = $upQty;
                $product->save();

                $cart->order_id = $order_id->id;
                $cart->save();
            }
 
            // session destroy for coupons after purchase
            if( Session::has('coupon') ){
                Session::forget('coupon');
            }

            // sending mail information
            $mailData = [
                'name'     => $request->c_name,
                'address'  => $request->c_address,
                'mail'     => $request->c_email,
            ];
 
            $customerMails = ['nh4647352@gmail.com', $request->c_email];

            foreach( $customerMails as $customerMail ){
            Mail::to($customerMail)->send(new InvoiceMail($mailData));
            }
 
            $notifications = [
             "message"    => "order placed successfully",
             'alert-type' => "success",
           ];
 
           return redirect()->route('homePage')->with($notifications);
        }

        

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function payViaAjax(Request $request)
    {

        # Here you have to receive all the order data to initate the payment.
        # Lets your oder trnsaction informations are saving in a table called "orders"
        # In orders table order uniq identity is "transaction_id","status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount'] = '10'; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = 'Customer Name';
        $post_data['cus_email'] = 'customer@mail.com';
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = '8801XXXXXXXXX';
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";


        #Before  going to initiate the payment order status need to update as Pending.
        $update_product = DB::table('orders')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'name'           => $post_data['cus_name'],
                'email'          => $post_data['cus_email'],
                'phone'          => $post_data['cus_phone'],
                'amount'         => $post_data['total_amount'],
                'status'         => 'Pending',
                'address'        => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'currency'       => $post_data['currency']
            ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function success(Request $request)
    {
        echo "Transaction is Successful";

        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Processing']);

                echo "<br >Transaction is successfully Completed";
            }
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            echo "Transaction is successfully Completed";
        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            echo "Invalid Transaction";
        }


    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);
            echo "Transaction is Falied";
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }

    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);
            echo "Transaction is Cancel";
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }


    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);

                    echo "Transaction is successfully Completed";
                }
            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }

}