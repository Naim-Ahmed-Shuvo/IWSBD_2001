@extends('backend.master')

@section('content')

     <div class="row mt-5">
         <div class="col-lg-12 text-right">
            <a href="" class="btn btn-success btn-sm f-right mr-4">Print Order</a>
         </div>
     </div>
    <div class="row mt-5 text-center">

        <div class="col-lg-12 ">
        <img src="{{url('/')}}/frontend-assets/img/logo/logo.png"  class="mb-2" alt="Logo">

        <ul style="list-style: none;">

            <li>1000 Lakepoint Dr, Frisco, CO 80443, USA </li>
            <li>Sweetcake@support.com</li>
            <li>+1 800-786-1000</li>
        </ul>


        </div>
    </div>

    <div class="row mt-5">
        <div class="col-lg-6" style="padding-left: 150px;">
            <h5 style="border-bottom: 1px solid orange; width: 300px">Shipping Info:</h5><br>
            @foreach ($shipping_info as $info)
              <h6>Name: {{Auth::user()->name}}</h6>
              <h6>Country: {{$info->country}}</h6>
              <h6>City: {{$info->city}}</h6>
              <h6>Phone: {{$info->phone}}</h6>
              <h6>Email: {{$info->email}}</h6>
            @endforeach


        </div>
        <div class="col-lg-6 " style="padding-left: 150px;">
            <h5 style="border-bottom: 1px solid #fc9003; width: 300px">Invoice Info:</h5><br>
            @foreach ($shipping_info as $info)

              <h6>Amount to be paid: BDT {{$info->amount}} Tk.</h6>
              <h6>Payment Type: {{$info->payment_type}}</h6>
              <h6>Order Placed: {{$info->created_at}}</h6>
            @endforeach


        </div>
    </div>

    <div class="row mt-5">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5>Purchased Items</h5>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-striped text-center">
                    <thead style="background: #03fc80;">
                      <tr>
                        <th scope="col">Sl</th>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total Amount (BDT)</th>

                      </tr>

                    </thead>
                    <tbody>

                      @foreach ($items as $key=>$item)
                        <tr>
                            <th scope="row">{{$key+1}}</th>
                            <td>{{$item->name}}</td>
                            <td><img height="100" width="100" src="{{url($item->image)}}" alt=""></td>
                            <td>{{$item->price}}</td>
                            <td>{{$item->quantity}}</td>
                            <td>{{$item->price*$item->quantity}} Tk</td>


                            </tr>

                      @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

