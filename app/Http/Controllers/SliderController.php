<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;
use Image;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;
class SliderController extends Controller
{
    function addSlider(){
    	return view('backend.sliders.add_slider');
    }

    function addSliderDetails(Request $req){
     	if( $req->hasFile('image')){
    		// img processing
    		$get_img = $req->file('image');
    		$img_name = time().'.'.$get_img->getClientOriginalExtension();
    		Image::make($get_img)->save('products_img/'.$img_name,100);

    		
            // slug
    		// $without_space = str_replace("  ", "-", $req->name);
    		// $without_SlashAndSpace = str_replace("/", "-", $without_space);
    		// $slug = str_replace(".", "-", $without_SlashAndSpace);


    		Slider::insert([
    			'image' => 'products_img/'.$img_name,
    			'sub_title'=> $req->sub_title,
    			'sub_title_color'=> $req->sub_title_color,
    			'title'=> $req->title,
    			'title_color'=> $req->title_color,
    			'text'=> $req->text,
    			'text_color'=> $req->text_color,
    			'link'=> $req->link,
    			'created_at' =>  Carbon::now()
    		]);
    	}

   Toastr::success('Slider Details inserted', 'Success', ["positionClass" => "toast-top-right"]);

        return back();
}

public function viewSlider(){
	$details = Slider::all();

	return view('backend.sliders.view_slider_details', compact('details'));
}



}