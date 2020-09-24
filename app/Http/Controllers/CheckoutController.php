<?php

namespace App\Http\Controllers;

use App\Billing;
use App\Cart;
use App\Category3;
use App\Http\Controllers\middlware;
use App\Sale;
use App\Shipping;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function proceedToCheckout(){
        $categories = Category3::all();

        $carts = DB::table('carts')
             ->join('products', 'carts.product_id', '=', 'products.id')
             ->select('carts.*', 'products.image as product_image', 'products.name as product_name')
             ->where('random_number', session('random_number'))
             ->orderBy('id', 'desc')
             ->get();


        $cart_products_numbers =Cart::where('random_number', session('random_number'))->count();

        return view('frontend.checkout', compact('categories', 'carts','cart_products_numbers'));
    }

    public function placetheOrder(Request $req){
        $shipping_id = Shipping::insertGetId([
            'user_id'=> Auth::user()->id,
            'name'=> $req->name,
            'email'=> $req->email,
            'contact'=> $req->contact,
            'address'=> $req->address,
            'country'=> $req->country,
            'city'=> $req->city,
            'shipping_date'=> $req->shipping_date,
            'order_note'=> $req->order_note,
            'created_at'=> Carbon::now(),
        ]);




        $sale_id = Sale::insert([
          'shipping_id'=> $shipping_id,
          'shipping_cost'=> 60,
          'discount'=> 0,
          'transaction_id'=> null,
          'currency'=> "BDT",
          'payment_type'=> "Cash On Delivery",
          'status'=> 0,
          'created_at'=> Carbon::now(),
        ]);

        $amount  = 0;
        $carts = Cart::where('random_number', session('random_number'))->get();
        foreach($carts as $item){
            $amount = $amount  + ($item->quantity*$item->price);
            Billing::insert([
               'random_number' => session('random_number'),
               'sale_id' => $sale_id,
               'product_id' => $item->product_id,
               'price' => $item->price,
               'quantity' => $item->quantity,

            ]);
        }


         Sale::where('id', $sale_id)->update([
            'amount' => $amount+60,
            'sub_total' => $amount,
         ]);
        $carts = Cart::where('random_number', session('random_number'))->delete();

        $data = "Thanks for shopping";
        // $email = Auth::user()->email;
        $email = "shuvonaim123@gmail.com";
        Mail::to($email)->send(new OrderMail($data));

        Toastr::success('Order placed', 'success', ["positionClass" => "toast-top-right"]);
        return redirect('/');
    }
}
