<?php

namespace App\Http\Controllers;

use App\Stuff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;

class StuffController extends Controller
{
    public function stuff_profile()
    {
        if(Stuff::where('user_id', Auth::user()->id)->exists()){
            $stuff_info = Stuff::where('user_id', Auth::user()->id)->first();
            return view('backend.view_stuff_profile', compact('stuff_info'));
        }
        else{
            $stuff_info = null;
            return view('backend.view_stuff_profile', compact('stuff_info'));
        }

    }

    public function update_stuff_profile(Request $request)
    {
        if(Stuff::where('user_id', Auth::user()->id)->exists()){
            if($request->hasFile('image')){
                $get_img = $request->file('image');
                $img_name = time().'.'.$get_img->getClientOriginalExtension();
                Image::make($get_img)->save('stuff_img/'.$img_name, 100);

                Stuff::where('user_id', Auth::user()->id)->update([
                    'name'        => $request->name,
                    'email'       => $request->email,
                    'user_id'     => Auth::user()->id,
                    'phone'     => $request->phone,
                    'n_id'         => $request->n_id,
                    'address'     => $request->address,
                    'image'       => 'stuff_img/'.$img_name,
                    'updated_at'  => Carbon::now(),
                ]);
                Toastr::success('Stuff Profile Updated Successfully', 'Success');
                return back();
            }

            else{
                Stuff::where('user_id', Auth::user()->id)->update([
                    'name'        => $request->name,
                    'email'       => $request->email,
                    'user_id'     => Auth::user()->id,
                    'phone'     => $request->phone,
                    'n_id'         => $request->n_id,
                    'address'     => $request->address,

                    'updated_at'  => Carbon::now(),
                ]);
                Toastr::success('Stuff Profile Updated Successfully', 'Success');
                return back();
            }
        }

        else{
            if($request->hasFile('image')){
                $get_img = $request->file('image');
                $img_name = time().'.'.$get_img->getClientOriginalExtension();
                Image::make($get_img)->save('stuff_img/'.$img_name, 100);

                Stuff::insert([
                    'name'        => $request->name,
                    'email'       => $request->email,
                    'user_id'     => Auth::user()->id,
                    'phone'     => $request->phone,
                    'n_id'         => $request->n_id,
                    'address'     => $request->address,
                    'image'       => 'stuff_img/'.$img_name,
                    'updated_at'  => Carbon::now(),
                ]);
                Toastr::success('Stuff Profile Updated Successfully', 'Success');
                return back();
            }

            else
            {
                Stuff::insert([
                    'name'        => $request->name,
                    'email'       => $request->email,
                    'user_id'     => Auth::user()->id,
                    'phone'     => $request->phone,
                    'n_id'         => $request->n_id,
                    'address'     => $request->address,

                    'updated_at'  => Carbon::now(),
                ]);
                Toastr::success('Stuff Profile Updated Successfully', 'Success');
                return redirect('/home');
            }
        }
    }
}
