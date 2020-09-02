@extends("backend.master")

@section('content')
 
   <div class="container">
    <div class="row">
       <div class="col-lg-5 mt-5" >
        <div class="card">
          <div class="card-header bg-warning text-white text-center"  >
            Edit SubCategory
          </div>
          <div class="card-body bg-info h-100">
            <form action="{{url('update/subcategory')}}" method="POST">
              @csrf

              <input type="hidden" name="subcategory_id" value="{{$data->id}}">

              <div class="form-group">
                <label>New Sub-Category Name</label>
                <input type="text" id="subcategory_name"  name="subcategory_name" value="{{$data->name}}" class="@error('subcategory_name') is-invalid @enderror" class="form-control" required="required" placeholder="category_name">
              </div>
               @error('subcategory_name')
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