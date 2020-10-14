@extends('backend.master')

@section('content')
    <div class="row mt-5 ml-5">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header " style="background: #f2a2c4">
                   <h5>Pending Orders</h5>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">Sl</th>
                        <th scope="col">Order Placed</th>
                        <th scope="col">Sale Id</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Discount</th>
                        <th scope="col">Total</th>
                        <th scope="col">Payment Type</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>

                       @foreach ($orders as $key=>$order)
                       <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$order->order_placed}}</td>
                        <td>{{$order->id}}</td>
                        <td>{{Auth::user()->name}}</td>
                        <td>{{$order->discount}}</td>
                        <td>{{$order->amount}}</td>
                        <td>{{$order->payment_type}}</td>
                        <td>
                        <a href="{{url('/confirm_order')}}/{{$order->id}}" class="btn btn-success btn-sm"><i class="fas fa-check-circle"></i></a>
                        <a href="{{url('/decline_order')}}/{{$order->id}}" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>
                        </td>

                      </tr>
                       @endforeach



                    </tbody>
                  </table>
            </div>
        </div>
    </div>
@endsection
