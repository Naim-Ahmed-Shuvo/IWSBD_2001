@extends('backend.master')

@section('content')
  <div class="container-fluid">
  	<div class="row">
  		<div class="col-lg-12">
  			<div class="card mt-3">
  				<div class="card-header bg-success text-white">
  					<b>View Slider Details</b>
  				</div>
  				<div class="card-body">
  					<table class="table table-striped table-bordered   ">
					  <thead>
					    <tr>
					      <th scope="col">ID</th>
					      <th scope="col">DATE</th>
					      <th scope="col">IMAGE</th>
					      <th scope="col">SUB_TITLE</th>
					      <th scope="col">SUB_TITLE_COLOR</th>
					      <th scope="col">TITLE</th>
					      <th scope="col">TITLE_COLOR</th>
					      <th scope="col">TEXT</th>
					      <th scope="col">TEXT_COLOR</th>
					      <th scope="col">LINK</th>
					      <th scope="col">Action</th>
					    </tr>
					  </thead>
					  <tbody>
					   @foreach($details as $detail)
                          <tr>
						      <th scope="row">{{$detail->id}}</th>
						      @php
						        $newdate = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $detail->created_at)->format('d M, Y');
						      @endphp
						      <td> {{$newdate}} </td>
						       <td>
						      	@if($detail->image !=null)
						      	  <img src="{{url($detail->image)}}" height="60" width="60">
						      	@endif  
						      </td>
						      <td>{{$detail->sub_title}}</td>
						      <td>{{$detail->sub_title_color}}</td>
						      <td>{{$detail->title}}</td>
						      <td>{{$detail->title_color}}</td>
						      <td>{{$detail->text}}</td>
						      <td>{{url('$detail->text_color')}}</td>
						      <td>{{$detail->link}}</td>
						     
						     
						      <td>
						      	<a href="" class="btn btn-warning btn-sm rounded">Edit</a>
						      	<a href="" class="btn btn-danger btn-sm rounded">Delete</a>
						      </td>
						     
					      </tr>
					   @endforeach
					  </tbody>
					</table>
  				</div>
  			</div>
  		</div>
  	</div>
  </div>
@endsection