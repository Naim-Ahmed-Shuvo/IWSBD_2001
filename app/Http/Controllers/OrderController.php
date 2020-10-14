<?php

namespace App\Http\Controllers;

use App\Sale;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function pending_orders()
    {
        $orders = DB::table('sales')
        ->join('shippings', 'sales.shipping_id', '=', 'shippings.id')
        ->select('sales.amount', 'sales.id', 'sales.discount', 'sales.payment_type', 'shippings.created_at as order_placed')
        ->where('status', 0)
        ->get();
        return view('backend.pending_order', compact('orders'));
    }

    public function confirm_order($id)
    {
        Sale::where('id', $id)->update([
           'status' => 1,
        ]);

        Toastr::success('Order placed successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return back();
    }

    public function decline_order($id)
    {
        Sale::find($id)->update([
            'status' => Null,
        ]);

        Toastr::error('Order Declined', 'Success', ["positionClass" => "toast-top-right"]);
        return back();
    }

    public function complete_orders()
    {
        $orders = DB::table('sales')
                   ->join('shippings', 'sales.shipping_id', '=', 'shippings.id')
                   ->select('sales.amount', 'sales.id', 'sales.discount', 'sales.payment_type', 'shippings.created_at as order_placed')
                   ->where('status', 1)
                   ->get();
        return view('backend.complete_order', compact('orders'));
    }

    public function view_order_details()
    {
        $items = DB::table('billings')
                    ->join('products', 'billings.product_id', '=', 'products.id')
                    ->select('billings.*', 'products.image', 'products.name')
                    ->get();

        $shipping_info = DB::table('sales')
                      ->join('shippings', 'sales.shipping_id', '=', 'shippings.id')
                      ->select('sales.*', 'shippings.*')
                      ->get();

        return view('backend.view_order_details', compact('items', 'shipping_info'));
    }

    public function decline_orders()
    {
        $orders = DB::table('sales')
                   ->join('shippings', 'sales.shipping_id', '=', 'shippings.id')
                   ->select('sales.amount', 'sales.id', 'sales.discount', 'sales.payment_type', 'shippings.created_at as order_placed')
                   ->where('status', 1)
                   ->get();

        return view('backend.decline_order', compact('orders'));
    }
}
