@extends('backend.master')

@section('content')

 <div class="container-fluid">
 	<div class="card mt-3">
 		<div class="card-header bg-info text-white">
 			Add New Product
 		</div>
 		<div class="card-body">
 			<form action="{{url('add/new/product')}}" method="POST" enctype="multipart/form-data">
 				@csrf

 				<div class="row">
 					<div class="col-lg-8">
	 					<div class="row">
	 					<div class="col-lg-4">
	 						<div class="form-group">
	 					<label>Category </label>
	 					<select class="form-control" name="category_id" id="category_id" required>
	 						<option>Select</option>

	 						@foreach($categories as $item)
	                              <option value="{{$item->id}}">{{$item->category_name}}</option>
	 						@endforeach
	 					</select>
	 				    </div>
	                   </div>


	 					<div class="col-lg-4">
	 							<div class="form-group">
				 					<label>SubCategory </label>
				 					<select class="form-control" name="subcategory_id" id="subcategory_id" >

				 					</select>
				 				</div>
	 					</div>
	 					<div class="col-lg-4">
	 						<div class="form-group">
				 					<label>Title </label>
				 					<input type="text" name="name" class="form-control" required="required">
				 				</div>

	 					</div>
	 				   </div>

		 				<div class="row mt-3">
		 					<div class="col-lg-12">
		 						<label>Description :</label>
		 						<!-- <textarea name="description" required="" class="form-control" placeholder="Description"></textarea> -->


		 						<textarea name="description" class="form-control"></textarea>
		 					</div>
		 				</div>


		 				<div class="row mt-3">
		 					<div class="col-lg-4">
		 						<label>Image :</label>
		 						<input type="file" name="image" onchange="document.getElementById('bah').src = window.URL.createObjectURL(this.files[0])" required="required" class="form-control">

		 						<img id="bah" class="img-fluid mt-1">
		 					</div>
		 					<div class="col-lg-4">
		 						<label>Stock :</label>
		 						<input type="number" name="stock" required="required" class="form-control">
		 					</div>
		 					<div class="col-lg-4">
		 						<label>Price :</label>
		 						<input type="number" name="price" required="required" class="form-control">
		 					</div>
		 				</div>
 				</div>
 				<div class="col-lg-4">
 					<div class="">
 						<label>Mutiple Image (Max-5)</label>
 						<input type="file" name="photos[]" class="form-control" id="upload_file" onchange="preview_image()" accept=".jpg, .JPG, .png, .jpeg" multiple>
 						<div id="image_preview"></div>
 					</div>
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


  <!-- multiple image -->

 <script type="text/javascript">
 	function preview_image(){
 		let totalfile = document.getElementById("upload_file").files.length;

 		if(totalfile < 5){
 			for(var i=0;i<totalfile;i++){
 				$('#image_preview').append("<img src='"+URL.createObjectURL(event.target.files[i])+"'> <br>");
 			}
 		}

 		else{
 			$('#image_preview').append('<h5>dont upload more than 5</h5>');
 		}
 	}
 </script>


<script>
   var route_prefix = "/filemanager";
  </script>

  <!-- CKEditor init -->
  <script src="//cdnjs.cloudflare.com/ajax/libs/ckeditor/4.5.11/ckeditor.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/ckeditor/4.5.11/adapters/jquery.js"></script>
  <script>
    $('textarea[name=description]').ckeditor({
      height: 200,
      filebrowserImageBrowseUrl: route_prefix + '?type=Images',
      filebrowserImageUploadUrl: route_prefix + '/upload?type=Images&_token={{csrf_token()}}',
      filebrowserBrowseUrl: route_prefix + '?type=Files',
      filebrowserUploadUrl: route_prefix + '/upload?type=Files&_token={{csrf_token()}}'
    });
  </script>

   <!-- drop-down dependency ajax -->
  <script>
		$(document).ready(function() {
		$('#category_id').on('change', function() {
		var type_id = $(this).val();
		if(type_id) {
		$.ajax({
		url: '/find/subcategory/by/category/'+type_id,
		type: "GET",
		data : {"_token":"{{ csrf_token() }}"},
		dataType: "json",
		success:function(data) {
		// console.log(data);
		if(data){
		$('#subcategory_id').empty();
		$('#subcategory_id').focus;
		$('#subcategory_id').append('<option value="">-- Select Sub-Category --</option>');
		$.each(data, function(key, value){
		$('select[name="subcategory_id"]').append('<option value="'+ value.id +'">' + value.name+ '</option>');
		});
		}
		else{
		$('#subcategory_id').empty();
		}
		}
		});
		}else{
		$('#subcategory_id').empty();
		}
		});
		});
</script>
@endsection
