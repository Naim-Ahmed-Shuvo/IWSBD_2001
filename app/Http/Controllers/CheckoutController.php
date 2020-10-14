<?php
namespace App\Http\Controllers;
use App\Category3;
use App\Product;
use App\cart;

use App\Billing;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;
use Brian2694\Toastr\Facades\Toastr;

use App\Contact;
use App\slider;
use App\division;
use App\district;
use App\Sale;
use App\upazila;
use App\Shipping;

use Illuminate\Http\Request;
class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function  proceedToCheckout(){
        $categories= Category3::all();
        $products=Product::orderBy('id','desc')->get();
        // $data=division::all();
        $carts=DB::table('carts')
                  ->join('products','carts.product_id','=','products.id')
                  ->select('carts.*','products.image as product_image','products.name as product_name')
                  ->where('random_number',session('random_number'))
                  ->orderBY('id','desc')
                  ->get();
          $cart_products_numbers=cart::where('random_number',session('random_number'))->count();
        return view('frontend.checkout',compact('categories','products','carts','cart_products_numbers'));
    }
    // public function districtBydivison($id){
    //     $districts=district::where('division_id',$id)->get();
    //     return response()->json($districts);
    // }
    // public function upazilaBydistrict($id){
    //     $upazilas=upazila::where('district_id',$id)->get();
    //     return response()->json($upazilas);
    // }

    public function place_order(Request $request)
    {
        if($request->check_method == 'Cash On Delivery'){
            $shipping_id = Shipping::insertGetId([
                'name' => $request->name,
                'user_id' => Auth::user()->id,
                'email' => $request->email,
                'phone' =>$request->phone,
                'address' =>$request->address,
                'country' =>$request->country,
                'city' =>$request->city,
                'shipping_date' =>$request->date,
                'payment_method' =>$request->check_method,
                'order_note' =>$request->order_note,
                'created_at' => Carbon::now(),
            ]);

            $sale_id=Sale::insertGetId([
                'shipping_id'=>$shipping_id,
                'shipping_cost'=>60,
                'discount'=>0,
                'transaction_id'=>null,
                'currency'=>"BDT",
                'payment_type'=>$request->check_method,
                'status'=>0,
                'created_at'=>Carbon::now(),
            ]);

            $amount=0;
            $carts = Cart::where('random_number',session('random_number'))->get();
            foreach($carts as $item){
                $amount=$amount+($item->price*$item->quantity);
                Billing::insert([
                    'random_number'=>session('random_number'),
                     'sale_id'=>$sale_id,
                     'product_id'=>$item->product_id,
                     'price'=> $item->price,
                     'quantity'=>$item->quantity,
               ]);

            }

            Sale::where('id', $sale_id)->update([
                'amount' => $amount+60,
                'sub_total' => $amount,
            ]);

            Cart::where('random_number', session('random_number'))->delete();

             Toastr::success('Order placed successfully', 'Success', ["positionClass" => "toast-top-right"]);
             return redirect('/');

        }

        else{
            $shipping_id = Shipping::insertGetId([
                'name' => $request->name,
                'user_id' => Auth::user()->id,
                'email' => $request->email,
                'phone' =>$request->phone,
                'address' =>$request->address,
                'country' =>$request->country,
                'city' =>$request->city,
                'shipping_date' =>$request->date,
                'payment_method' =>$request->check_method,
                'order_note' =>$request->order_note,
                'created_at' => Carbon::now(),
            ]);

            $sale_id=Sale::insertGetId([
                'shipping_id'=>$shipping_id,
                'shipping_cost'=>60,
                'discount'=>0,
                'transaction_id'=>null,
                'currency'=>"BDT",
                'payment_type'=>$request->check_method,
                'status'=>0,
                'created_at'=>Carbon::now(),
            ]);

            $amount=0;
            $carts = Cart::where('random_number',session('random_number'))->get();
            foreach($carts as $item){
                $amount=$amount+($item->price*$item->quantity);
                Billing::insert([
                    'random_number'=>session('random_number'),
                     'sale_id'=>$sale_id,
                     'product_id'=>$item->product_id,
                     'price'=> $item->price,
                     'quantity'=>$item->quantity,
               ]);

            }

            Sale::where('id', $sale_id)->update([
                'amount' => $amount+60,
                'sub_total' => $amount,
            ]);

            Cart::where('random_number', session('random_number'))->delete();

            session(['sale_id' => $sale_id]);
            session(['amount' => $amount+60]);
             Toastr::success('Order placed successfully', 'Success', ["positionClass" => "toast-top-right"]);
             return redirect('/stripe');
        }
    }
}
