<?php

namespace App\Http\Controllers;

use App\Billing;
use App\Cart;
use App\Category3;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Product;
use App\Sale;
use Session;
use App\Mail\OrderMail;
use Illuminate\Support\Facades\Mail;
use Stripe;


namespace App\Http\Controllers;



class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        // $categories = Category3::all();

        // $carts = DB::table('carts')
        //      ->join('products', 'carts.product_id', '=', 'products.id')
        //      ->select('carts.*', 'products.image as product_image', 'products.name as product_name')
        //      ->where('random_number', session('random_number'))
        //      ->orderBy('id', 'desc')
        //      ->get();


        // $cart_products_numbers =Cart::where('random_number', session('random_number'))->count();


        // $products = Product::orderBy('id','desc')->get();
        return view('frontend.stripe');
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)

    {
        $amount = session('amount');
        $sale_id = session('sale_id');
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => 100 * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com."
        ]);

        Sale::where('id', $sale_id)->update([
            'status' => 0
        ]);

        $data = Billing::where('sale_id', $sale_id)->get();
        // $email = Auth::user()->email;
        $email = "shuvonaim123@gmail.com";
        Mail::to($email)->send(new OrderMail($data));

        Session::flash('success', 'Payment successful!');

        return redirect('/');
    }
}
