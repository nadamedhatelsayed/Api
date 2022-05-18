<?php


namespace App\Repository\Api;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use Essam\TapPayment\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;

class  OrderRepository implements OrderRepositoryInterface
{
    public function create()
    {
        //create order and complete payment
        // dd(auth()->user());
        if (Auth::check()) {
            $carts = Cart::where('user_id', auth()->user()->id)->get();
            $order = Order::create([
                'user_id'     =>   auth()->user()->id,
                'total'       =>  0,
            ]);
            foreach ($carts as $cart) {
                OrderProduct::create([
                    'product_id' => $cart->product_id,
                    'order_id'   => $order->id,
                    'count'      => $cart->qty,
                    'price'      => $cart->price,
                ]);
                $order->update(['total' => $order->total + $cart->qty * $cart->price]);
            }
        } else {
            return response()->json([
                'message' => 'you must login first',
            ], 500);
        }
        
        return $this->paymentTab($order);
    }

    private function paymentTab($order)
    {
        $key = Config::get('app.key_tab');

        $TapPay = new Payment(['secret_api_Key' => $key]);

        $redirect = false; // return response as json , you can use it form mobile web view application
        // dd($order->total);
        $total = $order->total == 0?50:$order->total;
        $payment = $TapPay->charge([
            'amount' => $total,
            'currency' => 'SAR',
            'threeDSecure' => 'true',
            'description' => ' payment',
            'statement_descriptor' => 'test',
            'customer' => [
                'first_name' => 'test',
                'email' =>  auth()->user()->email,
            ],
            'source' => [
                'id' => 'src_card'
            ],
            'post' => [
                'url' => null
            ],
            'redirect' => [
                'url' => url("orders/redirect?order_id=$order->id")
            ]
        ], $redirect);
        // return redirect url payment 
        return $payment->transaction->url;
        // return Redirect::to($payment->transaction->url);
    }
    /**
     * 
     * return response  from payment gate 
     */
    public function orderRedirect($request)
    {

        $key = Config::get('app.key_tab');
        $secret_api_Key = $key;
        $TapPay = new Payment(['secret_api_Key' => $secret_api_Key]);
        $charge_id = $request->get('tap_id'); // from tap getaway response url
        $Charge =  $TapPay->getCharge($charge_id);
        if ($Charge != null && isset($Charge->object) && $Charge->object == "charge" && isset($Charge->status) && $Charge->status == "CAPTURED") {
            if (isset($request->order_id)) {

                return Redirect::to('/');
            }
        }
        dd('Error happend');
    }
}
