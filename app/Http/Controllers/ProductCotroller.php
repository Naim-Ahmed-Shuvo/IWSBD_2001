<?php

namespace App\Http\Controllers;
use App\Category3;
use App\Product;
use Carbon\Carbon;
use App\Subcategory;
use Image;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProductCotroller extends Controller
{
    public function addProductpage(){
    	$categories = Category3::all();
    	return view('backend.product.add_product', compact('categories'));
    } 

    public function addnewProduct(Request $req){
             
            // $photos = array();

            // $photos = $req->file('photos');
            
            // foreach ($photos as  $photo) {
            	

            // 	$destination_path = public_path().'/products_img/';
            // 	$extra_image_name = time().".".$photo->getClientOriginalExtension();
            // 	$photo->move($destination_path,$extra_image_name);
            // }

        // $files = $req->file('photos');

        // $count = 1;

        // foreach ($files as  $file) {
        //     # code...

        //     $file_name = $count. "jpe";
        //     $file->move(public_path('products_img'), $file_name);
        //     $count++;
        // }





    	if( $req->hasFile('image')){
    		// img processing
    		$get_img = $req->file('image');
    		$img_name = time().'.'.$get_img->getClientOriginalExtension();
    		Image::make($get_img)->save('products_img/'.$img_name,100);

    		
            // slug
    		$without_space = str_replace("  ", "-", $req->name);
    		$without_SlashAndSpace = str_replace("/", "-", $without_space);
    		$slug = str_replace(".", "-", $without_SlashAndSpace);


    		Product::insert([
    			'category_id' => $req->category_id,
    			'subcategory_id' => $req->category_id,
    			'name' => $req->name,
    			'description' => $req->description,
    			'image' => 'products_img/'.$img_name,
    			'stock' =>  $req->stock,
    			'price' =>  $req->price,
    			'slug' =>  $slug,
    			'created_at' =>  Carbon::now()
    		]);
    	}


    	 Toastr::success('Product inserted', 'Success', ["positionClass" => "toast-top-right"]);

        return back();
    }


    public function viewProduct(){
    	$products = DB::table('products')
		    	    ->join('category3s', 'products.category_id', '=', 'category3s.id')
		    	    ->select('products.*', 'category3s.category_name')
		    	    ->orderBy('id','desc')
		    	    ->paginate(15);
    	return view('backend.product.view_product', compact('products'));
    }

    public function subcategoryBycategory($id){
         $subcategories = Subcategory::where('category_id', $id)->get();

         return response()->json($subcategories);
    }


    function editProduct($id){
        $categories = Category3::all();
         $data = Product::where('id', $id)->first();

      return view('backend.product.edit_product', compact('data', 'categories'));
    }


     public function updateProduct(Request $request){

       // $validatedData = $request->validate([
       //                  'name' => 'required|min:3',
                        
       //                  ]);
        if ($request->image != null) {
            $product_info = Product::where('id', $request->product_id)->first();
            if ( $product_info->image != null ) {
                unlink($product_info->image);
            }

            // img processing
            $get_img =  $request->file('image');
            $img_name = time().'.'.$get_img->getClientOriginalExtension();
            Image::make($get_img)->save('products_img/'.$img_name,100);

            
            // slug
            $without_space = str_replace("  ", "-", $request->name);
            $without_SlashAndSpace = str_replace("/", "-", $without_space);
            $slug = str_replace(".", "-", $without_SlashAndSpace);


             Product::where('id', $request->product_id)->update([

                'category_id' => $request->category_id,
                'subcategory_id' => $request->category_id,
                'name' => $request->name,
                'description' =>$request->description,
                'image' => 'products_img/'.$img_name,
                'stock' =>  $request->stock,
                'price' =>  $request->price,
                'slug' =>  $slug,
                'updated_at' =>  Carbon::now()

                  ]);
             Toastr::success('product updated', 'success', ["positionClass" => "toast-top-right"]);
             return redirect('view/product');
        }

       
       else{
         // slug
            $without_space = str_replace("  ", "-", $request->name);
            $without_SlashAndSpace = str_replace("/", "-", $without_space);
            $slug = str_replace(".", "-", $without_SlashAndSpace);


             Product::where('id', $request->product_id)->update([

                    'category_id' => $request->category_id,
                    'subcategory_id' => $request->category_id,
                    'name' => $request->name,
                    'description' => $request->description,
                    'stock' =>  $request->stock,
                    'price' =>  $request->price,
                    'slug' =>  $slug,
                    'updated_at' =>  Carbon::now()

                  ]);

              Toastr::success('product updated', 'success', ["positionClass" => "toast-top-right"]);
       return redirect('view/product');
       }


        
    }


    function deleteProduct($id){
       
       $product_info = Product::where('id', $id)->first();

       if ($product_info->image != null) {
           unlink($product_info->image);
       }

        Product::where('id', $id)->delete();

         Toastr::success('product deleted', 'success', ["positionClass" => "toast-top-right"]);
       return back();
    }
}
