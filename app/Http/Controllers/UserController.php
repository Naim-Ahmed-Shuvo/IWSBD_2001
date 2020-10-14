<?php

namespace App\Http\Controllers;
use Brian2694\Toastr\Facades\Toastr;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;
class UserController extends Controller
{
    public function manage_stuff()
    {
        $users = User::all();
        return view('backend.manage_stuff', compact('users'));
    }

    public function add_users(Request $request)
    {
        if($request->hasFile('image')){
            $get_img = $request->file('image');
            $img_name = time().'.'.$get_img->getClientOriginalExtension();
            Image::make($get_img)->save('user_img/'.$img_name, 100);

            User::insert([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'image' => 'user_img/'.$img_name,
                'created_at' => Carbon::now(),
            ]);

            Toastr::success('User added', 'Success', ["positionClass" => "toast-top-right"]);

            // return redirect('/manage_stuff');
        }
    }
}
