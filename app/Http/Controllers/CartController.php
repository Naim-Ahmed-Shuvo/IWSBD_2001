<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Product;
use App\Cart;
use App\Category3;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $req){
        $data = Product::where('id',$req->product_id)->first();

        // if session has random number then no need to generate new random nummber
        if (Session::has('random_number')) {

        	// if product is same then increament quantity
        	if(Cart::where('random_number',session('random_number'))->where('product_id', $req->product_id)->exists())

        	{

        		Cart::where('random_number',session('random_number'))->where('product_id', $req->product_id)->increment('quantity',$req->quantity);
        		Toastr::success('product added to cart', 'success', ["positionClass" => "toast-top-right"]);
                return back();
        	}


             else{
             	Cart::insert([
    		'random_number'=>session('random_number'),
    		'product_id'=>$req->product_id,
    		'quantity'=>$req->quantity,
    		'price'=>$data->price,
    		'created_at'=>Carbon::now()
    		    ]);
             }






    	Toastr::success('product added to cart', 'success', ["positionClass" => "toast-top-right"]);
             return back();
        }

        else{
        	$random_number = Str::random(10);
    	session(['random_number'=>$random_number]);


    	Cart::insert([
    		'random_number'=>session('random_number'),
    		'product_id'=>$req->product_id,
    		'quantity'=>$req->quantity,
    		'price'=>$data->price,
    		'created_at'=>Carbon::now()

    	]);

    	Toastr::success('product added to cart', 'success', ["positionClass" => "toast-top-right"]);
             return back();
        }
    }
   function view_cart(){
    $categories = Category3::all();
    $carts = DB::table('carts')
    ->join('products', 'carts.product_id', '=', 'products.id')
    ->select('carts.*', 'products.image as product_image', 'products.name as product_name')
    ->where('random_number', session('random_number'))
    ->orderBy('id', 'desc')
    ->get();
    $cart_products_numbers =Cart::where('random_number', session('random_number'))->count();

       return view('frontend.cart', compact('carts', 'categories','cart_products_numbers'));
   }


    public function delete_cart($id){
           Cart::where('id', $id)->delete();
           Toastr::error('cart item deleted', 'succes', ["positionClass" => "toast-top-right"]);
             return back();
        }
}
