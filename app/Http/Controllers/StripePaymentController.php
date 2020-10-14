<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Stripe;
use App\Cart;
use App\Category3;
use Illuminate\Support\Facades\DB;
class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        $categories = Category3::all();
        $carts = DB::table('carts')
                    ->join('products', 'carts.product_id', '=', 'products.id')
                    ->select('carts.*', 'products.image as product_image', 'products.name as product_name')
                    ->where('random_number', session('random_number'))
                    ->orderBy('id', 'desc')
                    ->get();

        $cart_products_numbers =Cart::where('random_number', session('random_number'))->count();
        return view('frontend.stripe', compact('carts', 'categories', 'cart_products_numbers'));
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => 100 * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com."
        ]);

        Session::flash('success', 'Payment successful!');

        return back();
    }
}
