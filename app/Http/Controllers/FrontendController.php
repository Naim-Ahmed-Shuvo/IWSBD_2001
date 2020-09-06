<?php

namespace App\Http\Controllers;
use App\Category3;
use App\Product;
use App\Cart;
use App\Contact;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        $categories = Category3::all();

        $carts = DB::table('carts')
             ->join('products', 'carts.product_id', '=', 'products.id')
             ->select('carts.*', 'products.image as product_image', 'products.name as product_name')
             ->where('random_number', session('random_number'))
             ->orderBy('id', 'desc')
             ->get();


        $cart_products_numbers =Cart::where('random_number', session('random_number'))->count();

        
        $products = Product::orderBy('id','desc')->get();
        return view('frontend.index', compact('categories', 'products', 'carts', 'cart_products_numbers'));
    }

    public function Contact(){
        $categories = Category3::all();
         // $carts = Cart::where('random_number', session('random_number'))->orderBy('id', 'desc')->get();
        $maps = Contact::all();
        return view('frontend.contact', compact('maps', 'categories'));
        
    }
    public function Blog(){
        $categories = Category3::all();
         // $carts = Cart::where('random_number', session('random_number'))->orderBy('id', 'desc')->get();
        return view('frontend.blog', compact('categories'));
        
    }

    public function shop()
    { 
        $categories = Category3::all();
         
        return view('frontend.shop', compact('categories'));
    }

 
}
