<?php

namespace App\Http\Controllers;

use App\ShippingMethod;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
class ShippingMethodController extends Controller
{
    public function shipping_method()
    {
        $data = ShippingMethod::all();
        return view('backend.view_shipping_methods', compact('data'));
    }

    public function save_shipping_method(Request $request)
    {
        ShippingMethod::insert([
            'title' => $request->title,
            'duration' => $request->duration,
            'price' => $request->price,
            'date' => $request->date,
            'created_at' => Carbon::now(),
        ]);


    	Toastr::success('Shipping method added successfully', 'success', ["positionClass" => "toast-top-right"]);
        return back();
    }

    public function edit_shipping($id)
    {
        $data = ShippingMethod::find($id);
        return view('backend.edit_shipping_view', compact('data'));
    }

    public function update_shipping_method(Request $request)
    {
       ShippingMethod::where('id', $request->sm_id)->update([
        'title' => $request->title,
        'duration' => $request->duration,
        'price' => $request->price,
        'date' => $request->date,
        'updated_at' => Carbon::now(),
       ]);

       Toastr::success('Shipping method updated successfully', 'success', ["positionClass" => "toast-top-right"]);
       return redirect('/shipping_method');
    }

    public function delete_shipping($id)
    {
        ShippingMethod::find($id)->delete();
        Toastr::error('Shipping method deleted successfully', 'success', ["positionClass" => "toast-top-right"]);
        return back();
    }
}
