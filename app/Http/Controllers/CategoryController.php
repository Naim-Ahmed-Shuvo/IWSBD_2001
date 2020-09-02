<?php

namespace App\Http\Controllers;
use App\Category3;
use App\Product;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function category()
    {
        $categories = Category3::orderBy('id', 'desc')->paginate(8);
    	return view('backend.category', compact('categories'));
    }

    // public function form(){
    // 	return view('backend.form');
    // } 

    // public function table(){
    // 	return view('backend.table');
    // }

    public function addNewCategory(Request $request){
        // DB::table('categories')->insert([
        //     'category_name'-> $request->category-name
        // ]);
        $validatedData = $request->validate([
                        'category_name' => 'required|min:3',
                        
                        ]);
        if(Category3::where('category_name',$request->category_name)->exists())
        {
            Toastr::Warning('category exists', 'Warning', ["positionClass" => "toast-top-right"]);

            return back();
        }
        Category3::insert([
            'category_name'=> $request->category_name,
            'created_at'=> Carbon::now()
        ]);

        Toastr::success('category inserted', 'Success', ["positionClass" => "toast-top-right"]);

        return back();
    }

    public function deleteCategory($id){
        
        if (Product::where('category_id', $id)->exists()) {
            

             Toastr::warning('Product exists under this category', 'success', ["positionClass" => "toast-top-right"]);

            return back();
        }


       else{
          Category3::where('id', $id)->delete();
         Toastr::error('category delted', 'success', ["positionClass" => "toast-top-right"]);

         return back();
       }
    }

    public function editCategory($id){
        $data = Category3::where('id', $id)->first();
        return view('backend.edit-category', compact('data'));
    }

    public function updateCategory(Request $request){

          $validatedData = $request->validate([
                        'category_name' => 'required|min:3',
                        
                        ]);

          Category3::where('id', $request->category_id)->update([
              'category_name' => $request->category_name
          ]);
       Toastr::success('category updated', 'success', ["positionClass" => "toast-top-right"]);
       return redirect('category/backend/page');
    }
}
