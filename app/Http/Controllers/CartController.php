<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Product;
use App\Cart;
use Carbon\Carbon;
use Session;
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

    public function delete_cart($id){
           Cart::where('id', $id)->delete();
           Toastr::error('cart item deleted', 'succes', ["positionClass" => "toast-top-right"]);
             return back();
        }
}
