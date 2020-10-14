@extends('backend.master')

@section('content')
<div class="container">
    <div class="row text-center ml-1 mt-5">
        <div class="col-lg-4">
          <div class="card text-left" style="background: #e6e047; border-radius: 10px;">
            <div class="card-body">
              <h5 class="card-title">Pending Orders</h5>
              <p class="card-text">{{$pending_orders}}</p>
            <a href="{{url('/pending_orders')}}" class="btn btn-primary btn-sm" style="border-radius: 5px">See Pending Orders</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 ">
          <div class="card text-left text-light" style="background: #0aa33a; border-radius: 10px;">
            <div class="card-body">
              <h5 class="card-title">Complete Orders</h5>
              <p class="card-text">{{$complete_orders}}</p>
            <a href="{{url('/complete_orders')}}" class="btn btn-primary btn-sm" style="border-radius: 5px;">See Complete Orders</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 ">
          <div class="card text-left text-light" style="background: #ad1f37; border-radius: 10px;">
            <div class="card-body">
              <h5 class="card-title">Decline Orders</h5>
              <p class="card-text">{{$decline_orders}}</p>
            <a href="{{'/decline_orders'}}" class="btn btn-primary btn-sm" style="border-radius: 5px">See
                Decline Orders</a>
            </div>
          </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">

                    <h1>{{ $chart1->options['chart_title'] }}</h1>
                    {!! $chart1->renderHtml() !!}

                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
{!! $chart1->renderChartJsLibrary() !!}
{!! $chart1->renderJs() !!}
@endpush
