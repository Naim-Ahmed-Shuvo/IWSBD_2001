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
    public function placetheOrder(Request $request){
            if($request->check_method=="Cash On Delivery"){
                $shipping_id= Shipping::insertGetId([
                    'name'=>$request->name,
                    'user_id'=>Auth::user()->id,
                    'email'=>$request->email,
                    'contact'=>$request->contact,
                    'address'=>$request->address,

                    'shipping_date'=>$request->shipping_date,
                    'order_note'=>$request->order_note,
                    'created_at'=>Carbon::now(),
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
            $carts=cart::where('random_number',session('random_number'))->get();
            foreach($carts as $item){
                $amount=$amount+($item->price*$item->qty);
                Billing::insert([
                        'random_number'=>session('random_number'),
                         'sale_id'=>$sale_id,
                         'product_id'=>$item->product_id,
                         'price'=>$item->price,
                         'qty'=>$item->qty,
                ]);
            }
            Sale::where('id',$sale_id)->update([
                'amount'=>$amount+60,
                'sub_total'=>$amount,
            ]);
            cart::where('random_number',session('random_number'))->delete();
            $data=DB::table('billings')
                        ->join('allproducts','billings.product_id','=','allproducts.id')
                        ->select('billings.*','allproducts.name as product_name')
                        -> where('sale_id', $sale_id)
                        ->get();
            $email=Auth::user()->email;
            Mail::to($email)->send(new OrderMail($data));
            Toastr::success('order success', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect('/');
            }else{
                $shipping_id= Shipping::insertGetId([
                    'name'=>$request->name,
                    'user_id'=>Auth::user()->id,
                    'email'=>$request->email,
                    'contact'=>$request->contact,
                    'address'=>$request->address,
                    // 'devision'=>$request->division_id,
                    // 'district'=>$request->district_id,
                    // 'upazila'=>$request->upazila_id,
                    'shipping_date'=>$request->shipping_date,
                    'order_note'=>$request->order_note,
                    'created_at'=>Carbon::now(),
            ]);
            $sale_id=Sale::insertGetId([
                'shipping_id'=>$shipping_id,
                'shipping_cost'=>60,
                'discount'=>0,
                'transaction_id'=>null,
                'currency'=>"BDT",
                'payment_type'=>$request->check_method,
                'status'=>null,
                'created_at'=>Carbon::now(),
            ]);
            $amount=0;
            $carts=cart::where('random_number',session('random_number'))->get();
            foreach($carts as $item){
                $amount=$amount+($item->price*$item->quantity);
                Billing::insert([
                        'random_number'=>session('random_number'),
                         'sale_id'=>$sale_id,
                         'product_id'=>$item->product_id,
                         'price'=>$item->price,
                         'quantity'=>$item->quantity,
                ]);
            }
            Sale::where('id',$sale_id)->update([
                'amount'=>$amount+60,
                'sub_total'=>$amount,
            ]);
            session(['saleId'=>$sale_id]);
            session(['amount'=>$amount+60]);
            cart::where('random_number',session('random_number'))->delete();
            return redirect('/stripe');
            // $data="Email has been send";
            // $email=Auth::user()->email;
            // Mail::to($email)->send(new OrderMail($data));
            // Toastr::success('order success', 'Success', ["positionClass" => "toast-top-right"]);
            // return redirect('/');
            }
    }
}
