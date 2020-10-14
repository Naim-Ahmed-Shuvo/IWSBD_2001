@extends('backend.master')

@section('content')

 <div class="container-fluid">
 	<div class="card mt-3">
 		<div class="card-header bg-info text-white">
 			Stuff Profile
 		</div>
 		<div class="card-body">
 			<form action="{{url('/update_stuff_profile')}}" method="POST" enctype="multipart/form-data">
 				@csrf

              <div class="row">
                  <div class="col-lg-7">
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" name="name" class="form-control" value="{{Auth::user()->name}}" placeholder="name">
                            </div>
                            <div class="col-lg-6">
                            <input type="email" name="email" class="form-control" value="{{Auth::user()->email}}" placeholder="email">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-lg-6">
                                <input type="text" name="phone" class="form-control" placeholder="phone">
                            </div>

                            <div class="col-lg-6">
                                <input type="text" name="n_id" class="form-control" placeholder="n_id">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-lg-12">
                                <textarea name="" id="" cols="30" rows="3"  class="form-control"></textarea>

                            </div>
                        </div>
                  </div>

                 <div class="col-lg-5">
                    <input type="file" name="image" onchange="document.getElementById('bah').src = window.URL.createObjectURL(this.files[0])" required="required" class="form-control">

                    <img id="bah" class="img-fluid mt-1">
                 </div>
              </div>


                <button type="submit" class="btn btn-info btn-hover mt-5" >Update</button>
 			</form>
 		</div>
 	</div>
 </div>

@endsection


