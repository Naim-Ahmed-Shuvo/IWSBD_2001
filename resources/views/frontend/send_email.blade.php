<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>Order Information:</h2>
<h2>Order id: </h2>
   <div class="container">
       <div class="row">
           <div class="col-lg-12">
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                            $deliveri_carge = 60;
                            $subtotal = 0;
                        @endphp
                        @foreach ($order as $item)
                        <tr>
                        <th scope="row">{{$item->id}}</th>
                            <td>Name</td>
                            <td>{{$item->price}}</td>
                            <td>{{$item->name}}</td>
                        </tr>
                        @php
                        $amount = $subtotal+({{$tem->price}}*{{$item->quantity}});
                    @endphp
                        @endforeach


                        <h4>Delivery Charge: {{$deliveri_carge}}/=</h4>
                        <h4>Toatal Amount to Pay:{{$amount+60}}/=</h4>
                        <h5>Thank You....</h5>
                    </tbody>
                </table>
           </div>
       </div>
   </div>
</body>
</html>
