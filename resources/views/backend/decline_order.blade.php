@extends('backend.master')

@section('content')
    <div class="row mt-5 ml-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-danger text-white">
                   <h5>Decline Orders</h5>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-bordered">
                    <thead >
                      <tr>
                        <th scope="col">Sl</th>
                        <th scope="col">Order Placed</th>
                        <th scope="col">Sale Id</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Discount</th>
                        <th scope="col">Total</th>
                        <th scope="col">Payment Type</th>

                      </tr>
                    </thead>
                    <tbody>

                        @foreach ($orders as $key=>$order)
                        <tr>
                        <th scope="row">{{$key+1}}</th>
                            <td>{{$order->order_placed}}</td>
                            <td>{{$order->id}}</td>
                            <td>{{Auth::user()->name}}</td>
                            <td>{{$order->discount}}</td>
                            <td>{{$order->amount}}</td>
                            <td>{{$order->payment_type}}</td>


                          </tr>
                        @endforeach

                    </tbody>
                  </table>
            </div>
        </div>
    </div>
@endsection
