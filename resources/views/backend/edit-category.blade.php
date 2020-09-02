@extends("backend.master")

@section('content')
 
   <div class="container">
   	<div class="row">
   	   <div class="col-lg-5 mt-5" >
   	   	<div class="card">
   	   		<div class="card-header bg-warning text-white text-center"  >
   	   			Edit Category
   	   		</div>
   	   		<div class="card-body bg-info h-100">
   	   			<form action="{{url('update/category')}}" method="POST">
   	   				@csrf

              <input type="hidden" name="category_id" value="{{$data->id}}">

   	   				<div class="form-group">
   	   					<label>Category Name</label>
   	   					<input type="text" id="category_name"  name="category_name" value="{{$data->category_name}}" class="@error('category_name') is-invalid @enderror" class="form-control" required="required" placeholder="category_name">
   	   				</div>
               @error('category_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror



   	   				<div class="form-group text-center">
   	   					<input type="submit" value="Edit Category" class="btn btn-sm btn-success rounded mt-3">
   	   				</div>
   	   			</form>
   	   		</div>
   	   	</div>
	  </div>
		  
        

@endsection