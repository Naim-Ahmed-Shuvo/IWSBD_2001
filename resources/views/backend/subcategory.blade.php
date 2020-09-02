@extends("backend.master")

@section('content')
 
   <div class="container">
   	<div class="row">
   	   <div class="col-lg-5 mt-5" >
   	   	<div class="card">
   	   		<div class="card-header bg-info text-white text-center"  >
   	   			New Sub Category
   	   		</div>
   	   		<div class="card-body bg-warning h-100">
   	   			<form action="{{url('new-sub/category')}}" method="POST">
   	   				@csrf
                     
                     <div class="form-group">
                     	<label>Select Category</label>
                     <select name="category_id" class="form-control">
                     	    <option value="">Select One</option>
                         @foreach($categories as $category)
                         
                     	<option value="{{$category->id}}">{{$category->category_name}}</option>
                     	@endforeach
                     </select>
                     </div>

   	   				<div class="form-group">
   	   					<label>Sub-Category Name</label>
   	   					<input type="text" id="subcategory_name"  name="subcategory_name" class="@error('subcategory_name') is-invalid @enderror" class="form-control" required="required" placeholder="subcategory_name">
   	   				</div>
               @error('subcategory_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror


                <div class="form-group">
                <label>Child-Category Name</label>
                <input type="text" id="childcategory_name"  name="childcategory_name" class="@error('childcategory_name') is-invalid @enderror" class="form-control" required="required" placeholder="childcategory_name">
              </div>
               @error('childcategory_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror



   	   				<div class="form-group text-center">
   	   					<input type="submit" value="Add SubCategory" class="btn btn-sm btn-success rounded mt-3">
   	   				</div>
   	   			</form>
   	   		</div>
   	   	</div>
	  </div>
		  
         <div class="col-lg-7">
		     <div class="card mt-3">
              <div class="card-header bg-info text-white text-center">
                 <b>Categories View</b>

              </div>    
              <div class="card-body">
                 <table class="table table-striped">
            <thead>
               <tr>
               <th scope="col">SL</th>
               <th scope="col">CATEGORY NAME</th>
               <th scope="col">SUB-CATEGORY NAME</th>
               <th scope="col">CHILD-CATEGORY NAME</th>
               <th scope="col">DATE</th>
               <th scope="col">ACTION</th>
               </tr>
            </thead>
            <tbody>
            	@foreach($subcategories as $subcategory)
	            <tr>
	               <th scope="row">1</th>
	               <td>{{$subcategory->category_name}}</td>
	               <td>{{$subcategory->name}}</td>
                 <td>{{$subcategory->child_category}}</td>
	               <td>{{$subcategory->created_at}}</td>
	              <td><a href="{{url('delete/subcategory')}}/{{$subcategory->id}}" class="btn btn-sm btn-danger rounded"><i class="far fa-trash-alt"></i></a></td>

	              <td><a href="{{url('edit/subcategory')}}/{{$subcategory->id}}" class="btn btn-sm btn-warning rounded"><i class="far fa-edit"></i></a></td>
               </tr>
               @endforeach
            </tbody>
            </table>
                  {{$subcategories->links()}}
              </div>    
          
           </div>
		 </div>

   	</div>
   </div>

@endsection