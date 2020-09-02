@extends('backend.master')

@section('content')
   <div class="container-fluid">
 	<div class="card mt-3">
 		<div class="card-header bg-info text-white">
 			Add Slider 
 		</div>
 		<div class="card-body">
 			<form action="{{url('add_slider/details')}}" method="POST" enctype="multipart/form-data">
 				@csrf
             <div class="row mt-3">
		 					<div class="col-lg-4">
		 						<label>Image :</label>
		 						<input type="file" name="image" onchange="document.getElementById('bah').src = window.URL.createObjectURL(this.files[0])" required="required" class="form-control">

		 						<img id="bah" class="img-fluid mt-1">
		 					</div>

		 					<div class="col-lg-4">
		 						<label>Sub Title</label>
		 						<input type="text" name="sub_title"  class="form-control">

		 						
		 					</div>

		 						<div class="col-lg-4">
		 						<label>Sub Title Color</label>
		 						<input type="color" name="sub_title_color"  class="form-control">
                                 </div>
		 						
		 					<div class="col-lg-4">
		 						<label> Title </label>
		 						<input type="text" name="title"  class="form-control">
                                 </div>

                                 <div class="col-lg-4">
		 						<label> Title Color</label>
		 						<input type="color" name="title_color"  class="form-control" >
                                 </div>


                                 <div class="col-lg-4">
		 						<label> Text</label>
		 						<input type="text" name="text"  class="form-control">
                                 </div> 


                                 <div class="col-lg-4">
		 						<label> Text Color</label>
		 						<input type="color" name="text_color"  class="form-control">
                                 </div> 


                                 <div class="col-lg-4">
		 						<label> Link</label>
		 						<input type="text" name="link"  class="form-control">
                                 </div>


 				</div>

 				  <div class="row mt-3">
 					<div class="col-lg-12">
 						
 						<input type="submit" class="btn btn-success rounded" value="Submit">
 					</div>
 				</div>
 			</form>
 		</div>
 	</div>
 </div>
@endsection


@section('footer_js')



@endsection