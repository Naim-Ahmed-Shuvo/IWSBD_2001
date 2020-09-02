<?php

namespace App\Http\Controllers;
use App\Category3;
use App\Contact;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        $categories = Category3::all();
        return view('frontend.index', compact('categories'));
    }

    public function Contact(){
        $maps = Contact::all();
        return view('frontend.contact', compact('maps'));
        
    }
    public function Blog(){
        return view('frontend.blog');
        
    }

    public function shop()
    {
        return view('frontend.shop');
    }

  
    
}
