<?php

namespace App\Http\Controllers;
use App\Category3;
use Carbon\Carbon;
use App\SubCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubCategoryController extends Controller
{
    public function subCategory(){
    	$categories = Category3::all();

       $subcategories =  DB::table('sub_categories')
					          ->join('category3s', 'sub_categories.category_id', '=', 'category3s.id')
					          ->select('sub_categories.*', 'category3s.category_name')
					          ->orderBy('id', 'desc')
					          ->paginate(8);

    	return view('backend.subcategory', compact('categories', 'subcategories'));
    }

    public function newsubCategory(Request $request){
        
          $validatedData = $request->validate([
                        'subcategory_name' => 'required|min:3',
                        
                        ]);

    	SubCategory::insert([
           'category_id'=>$request->category_id,
           'name'=>$request->subcategory_name,
           'child_category'=>$request->childcategory_name,
           'created_at'=>Carbon::now()

    	]);

       Toastr::success('sub-category updated', 'success', ["positionClass" => "toast-top-right"]);
       return back();
    }

    public function delsubCategory($id){
            SubCategory::where('id', $id)->delete();


             Toastr::success('sub-category deleted', 'success', ["positionClass" => "toast-top-right"]);
              return back();
    }

    public function editdatesubCategory($id){
      $data = SubCategory::where('id', $id)->first();

      return view('backend.editsubcategory', compact('data'));
    }

    public function updatesubCategory(Request $request){

       // $validatedData = $request->validate([
       //                  'name' => 'required|min:3',
                        
       //                  ]);

       SubCategory::where('id', $request->subcategory_id)->update([
        'name'=> $request->subcategory_name
       ]);


         Toastr::success('sub-category updated', 'success', ["positionClass" => "toast-top-right"]);
       return redirect('subcategory/backend/page');
    }
}
