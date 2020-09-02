@extends('backend.master')

@section('content')
  <div class="container-fluid">
  	<div class="row">
  		<div class="col-lg-12">
  			<div class="card mt-3">
  				<div class="card-header bg-success text-white">
  					<b>View All Products</b>
  				</div>
  				<div class="card-body">
  					<table class="table table-striped table-bordered   ">
					  <thead>
					    <tr>
					      <th scope="col">ID</th>
					      <th scope="col">DATE</th>
					      <th scope="col">CATEGORY</th>
					      <th scope="col">NAME</th>
					      <th scope="col">IMAGE</th>
					      <th scope="col">PRICE</th>
					      <th scope="col">STOCK</th>
					      <th scope="col">ACTION</th>
					    </tr>
					  </thead>
					  <tbody>
					   @foreach($products as $index=>$product)
                          <tr>
						      <th scope="row">{{$index+$products->firstItem()}}</th>
						      @php
						        $newdate = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $product->created_at)->format('d M, Y');
						      @endphp
						      <td> {{$newdate}} </td>
						      <td>{{$product->category_name}}</td>
						      <td>{{$product->name}}</td>
						      <td>
						      	@if($product->image !=null)
						      	  <img src="{{url($product->image)}}" height="60" width="60">
						      	@endif  
						      </td>
						      <td>{{$product->price}}</td>
						      <td>{{$product->stock}}</td>
						      <td>
						      	<a href="{{url('edit/product')}}/{{$product->id}}" class="btn btn-warning btn-sm rounded">Edit</a>
						      	<a href="{{url('delete/product')}}/{{$product->id}}" class="btn btn-danger btn-sm rounded">Delete</a>
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