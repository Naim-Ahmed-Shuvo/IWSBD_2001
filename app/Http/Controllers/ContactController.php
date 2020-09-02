<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;
use App\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){
            return view('backend.contact');
    }
    public function contact_submit(Request $req){
            Contact::insert([
                'map'=>$req->map,
                'address'=>$req->address,
                'email'=>$req->email,
                'contact_number'=>$req->contact_number,
            ]);

            Toastr::success('Your Information has been recorded', 'Success', ["positionClass" => "toast-top-right"]);

            return back();
    }
}