@extends('backend.master')

@section('content')
<div class="container">
   	<div class="row">
   	   <div class="col-lg-5 mt-5" >
          <form action="{{url('contact/submit')}}" method="POST">
              @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Map</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="map" aria-describedby="emailHelp" placeholder="Map">
                    
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Addres</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="address" placeholder="address">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Email</label>
                    <input type="email" class="form-control" id="exampleInputPassword1" name="email" placeholder="email">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Contact Number</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="contact_number" placeholder="contact_number">
                </div>
               
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
      </div>
       </div>
</div>
@endsection