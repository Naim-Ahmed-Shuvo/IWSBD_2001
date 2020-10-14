@extends('frontend.master')

@section('content')
      <!--breadcrumbs area start-->
      <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="index.html">home</a></li>
                            <li>Checkout</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->

    <!--Checkout page section-->
    <div class="Checkout_section mt-60">
       <div class="container">
        <form action="{{url('/place_order')}}" method="POST">
            @csrf
            <div class="checkout_form">
                <div class="row">
                    <div class="col-lg-6 col-md-6">

                            <h3>Billing Details</h3>
                            <div class="row">

                                <div class="col-lg-6 mb-20">
                                    <label> Name <span>*</span></label>
                                <input name="name" value="{{Auth::user()->name}}" type="text">
                                </div>
                                <div class="col-lg-6 mb-20">
                                    <label>Date  <span>*</span></label>
                                    <input type="date">
                                </div>

                                <div class="col-12 mb-20">
                                    <label for="country">country <span>*</span></label>
                                    <select class="niceselect_option" name="country" id="country">
                                        <option value="2">bangladesh</option>
                                        <option value="3">Algeria</option>
                                        <option value="4">Afghanistan</option>
                                        <option value="5">Ghana</option>
                                        <option value="6">Albania</option>
                                        <option value="7">Bahrain</option>
                                        <option value="8">Colombia</option>
                                        <option value="9">Dominican Republic</option>

                                    </select>
                                </div>
                                <div class="col-12 mb-20">
                                    <label> City <span>*</span></label>
                                    <input name="city" type="text">
                                </div>

                                <div class="col-12 mb-20">
                                    <label>Address  <span>*</span></label>
                                    <input name="address" placeholder="House number and street name" type="text">
                                </div>



                                <div class="col-lg-6 mb-20">
                                    <label>Phone<span>*</span></label>
                                    <input name="phone" type="text">

                                </div>
                                 <div class="col-lg-6 mb-20">
                                    <label> Email Address   <span>*</span></label>
                                      <input name="email" type="email">

                                </div>


                                <div class="col-12">
                                    <div class="order-notes">
                                         <label for="order_note">Order Notes</label>
                                        <textarea id="order_note" name="order_notes" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                    </div>
                                </div>
                            </div>

                    </div>
                    <div class="col-lg-6 col-md-6">

                            <h3>Your order</h3>
                            <div class="order_table table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($carts as $item)
                                        <tr>
                                            <td> {{$item->product_name}} <strong> × {{$item->quantity}}</strong></td>
                                            <td> {{$item->price*$item->quantity}}</td>
                                        </tr>
                                        @endforeach


                                    </tbody>
                                    @php
                                        $total = 0;
                                        $shipping_cost = 60;
                                        foreach($carts as $item){
                                            $total = $total+($item->price*$item->quantity);
                                        }
                                    @endphp
                                    <tfoot>
                                        <tr>
                                            <th>Cart Subtotal</th>
                                            <td>{{$total}} Tk.</td>
                                        </tr>
                                        <tr>
                                            <th>Shipping</th>
                                            <td><strong>{{$shipping_cost}} Tk.</strong></td>
                                        </tr>
                                        <tr class="order_total">
                                            <th>Order Total</th>
                                            <td><strong>{{$total+$shipping_cost}}</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="payment_method">
                               <div class="panel-default">
                                    <input id="payment" name="check_method" value="Cash On Delivery" type="radio" data-target="createp_account" />
                                    <label for="payment" data-toggle="collapse" data-target="#method" aria-controls="method">Cash On Delivery</label>


                                </div>
                               <div class="panel-default">
                                    <input id="payment_defult" name="check_method" value="Stripe" type="radio" data-target="createp_account" />
                                    <label for="payment_defult" data-toggle="collapse" data-target="#collapsedefult" aria-controls="collapsedefult">Stripe <img src="assets/img/icon/papyel.png" alt=""></label>


                                </div>
                                <div class="order_button">
                                    <button  type="submit">Proceed to PayPal</button>
                                </div>
                            </div>

                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
    <!--Checkout page section end-->
@endsection

