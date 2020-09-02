
@extends("backend.master")

@section('content')
 
   <div class="container">
   	<div class="row">
   	   <div class="col-lg-5 mt-5" >
   	   	<div class="card">
   	   		<div class="card-header bg-info text-white text-center"  >
   	   			New Category
   	   		</div>
   	   		<div class="card-body bg-warning h-100">
   	   			<form action="{{url('new/category')}}" method="POST">
   	   				@csrf

   	   				<div class="form-group">
   	   					<label>Category Name</label>
   	   					<input type="text" id="category_name"  name="category_name" class="@error('category_name') is-invalid @enderror" class="form-control" required="required" placeholder="category_name">
   	   				</div>
               @error('category_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror



   	   				<div class="form-group text-center">
   	   					<input type="submit" value="Add Category" class="btn btn-sm btn-success rounded mt-3">
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
               <th scope="col">ID</th>
               <th scope="col">CATEGORY NAME</th>
               <th scope="col">DATE</th>
               <th scope="col">ACTION</th>
               </tr>
            </thead>
            <tbody>
               
               @foreach($categories as $index=>$category)
               <tr>
               <th scope="row">{{$index+$categories->firstItem()}}</th>
               <td>{{$category->category_name}}</td>
               <td>{{$category->created_at}}</td>
               <td><a href="{{url('delete/category')}}/{{$category->id}}" class="btn btn-sm btn-danger rounded"><i class="far fa-trash-alt"></i></a></td>

                <td><a href="{{url('edit/category')}}/{{$category->id}}" class="btn btn-sm btn-warning rounded"><i class="far fa-edit"></i></a></td>
               </tr>
               
               @endforeach
               
            </tbody>
            </table>
            {{$categories->links()}}
              </div>    
          
           </div>
		 </div>

   	</div>
   </div>

@endsection