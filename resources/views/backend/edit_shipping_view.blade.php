@extends('backend.master')

@section('content')
    <div class="container">
        <div class="row mt-5 ml-5">
            <div class="col-lg-6 w-100" style="box-shadow: -2px -2px 3px #cecfd6, 2px 2px 3px #cecfd6">
               <div class="card "  >
                   <div class="card-header"  style="border-bottom: 3px solid #a2d6eb">
                       <h5>Edit Shipping</h5>
                   </div>

                   <div class="card-body">
                    <form action="{{url('/update_shipping_method')}}" method="POST">
                        @csrf
                    <input type="hidden" name="sm_id" value="{{$data->id}}">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Title</label>
                                <input type="text" class="form-control" name="title" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$data->title}}" placeholder="">

                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Duration</label>
                            <input type="text" class="form-control" name="duration" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$data->duration}}" placeholder=" ">

                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Price</label>
                            <input type="text" class="form-control" name="price" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$data->price}}" placeholder="">

                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Date</label>
                            <input type="date" class="form-control" name="date" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$data->date}}" placeholder=" ">

                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save </button>
                          </div>
                    </form>
                   </div>
               </div>


            </div>
        </div>
    </div>
@endsection
