<?php
    
namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Mail\invoiceMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Billing;
use App\Models\Order;
use App\Models\OrderProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Stripe;
     
class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        return view('payment.stripe');
    }
    
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        $payable_amount = Order::where('order_id' , session('order_id'))->first()->total;
        $order = OrderProduct::where('order_id' , session('order_id'))->first();
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        Stripe\Charge::create ([
                "amount" => 100 * $payable_amount,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from stripe.com"
        ]);

        Order::where('order_id' , session('order_id'))->update([
            'payment' => 2,
            'updated_at' => Carbon::now(),
        ]);
        $product = OrderProduct::where('order_id' , session('order_id'))->get();
        foreach ($product as $product) {
            Inventory::where('product_id' , $product->product_id)->where('color_id' , $product->color_id)->where('size_id' , $product->size_id)->where('material_id' , $product->material_id)->decrement('quantity' , $product->quantity);
        }
            
        Mail::to(Billing::where('order_id', session('order_id'))->first()->email)->send(new invoiceMail(session('order_id')));
      
        Session::flash('success', 'Payment successful!');
              
        return redirect(url('/order_placed'));
    }
}
