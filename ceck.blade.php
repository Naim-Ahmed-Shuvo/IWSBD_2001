@extends('frontend.master')
@section('content')
<!--breadcrumbs area start-->
<div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="{{url('/')}}">home</a></li>
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
            <div class="checkout_form">
                <form action="{{url('place/the/order')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                                <h3>Billing Details</h3>
                                <div class="row">
                                    <div class="col-lg-6 mb-20">
                                        <label>Full Name <span>*</span></label>
                                        <input type="text" name="name" value="{{Auth::user()->name}}">
                                    </div>
                                    <div class="col-12 mb-20">
                                        <label for="">Devision <span>*</span></label>
                                        <select class="form-control" name="division_id" id="division_id" require>
                                        <option value="">select</option>
                                        @foreach($data as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 mb-20">
                                        <label for="">District <span>*</span></label>
                                        <select class="form-control" name="district_id" id="district_id">
                                        </select>
                                    </div>
                                    <div class="col-12 mb-20">
                                        <label for="">Upazila <span>*</span></label>
                                        <select class="form-control" name="upazila_id" id="upazila_id">
                                        </select>
                                    </div>
                                    <div class="col-12 mb-20">
                                        <label>Street address  <span>*</span></label>
                                        <input placeholder="House number and street name" name="address" type="text">
                                    </div>
                                    <div class="col-lg-6 mb-20">
                                        <label>Phone<span>*</span></label>
                                        <input type="text" name="contact">
                                    </div>
                                    <div class="col-lg-6 mb-20">
                                        <label> Email Address   <span>*</span></label>
                                        <input type="text" name="email" value="{{Auth::user()->email}}">
                                    </div>
                                    <div class="col-lg-6 mb-20">
                                        <label> Shipping Date  <span>*</span></label>
                                        <input type="date" name="shipping_date">
                                    </div>
                                    <div class="col-12">
                                        <div class="order-notes">
                                            <label for="order_note">Order Notes</label>
                                            <textarea name="order_note" id="order_note" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
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
                                            @foreach($carts as $item)
                                            <tr>
                                                <td> {{$item->product_name}} <strong> × {{$item->qty}}</strong></td>
                                                <td> TK.{{$item->price*$item->qty}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                                    @php
                                                        $amount=0;
                                                        foreach($carts as $item){
                                                            $amount=$amount+($item->qty * $item->price);
                                                        }
                                                    @endphp
                                        <tfoot>
                                            <tr>
                                                <th>Cart Subtotal</th>
                                                <td>TK.{{$amount}}</td>
                                            </tr>
                                            <tr>
                                                <th>Shipping</th>
                                                <td><strong>TK.60</strong></td>
                                            </tr>
                                            <tr class="order_total">
                                                <th>Order Total</th>
                                                <td><strong>{{$amount+60}}</strong></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="payment_method">
                                <div class="panel-default">
                                        <input id="payment_defult" name="check_method" value="Cash On Delivery" type="radio" data-target="createp_account" />
                                        <label for="payment_defult" data-toggle="collapse" data-target="#collapsedefult1" aria-controls="collapsedefult1">Cash on Delivery <img src="assets/img/icon/papyel.png" alt=""></label>
                                        <div id="collapsedefult" class="collapse one" data-parent="#accordion">
                                            <div class="card-body1">
                                            <p>Pay via Cash on Delivery.</p>
                                            </div>
                                        </div>
                                        <input id="payment_defult1" name="check_method" value="Stripe" type="radio" data-target="createp_account" />
                                        <label for="payment_defult1" data-toggle="collapse" data-target="#collapsedefult1" aria-controls="collapsedefult1">Stripe<img src="assets/img/icon/papyel.png" alt=""></label>
                                        <div id="collapsedefult" class="collapse one" data-parent="#accordion">
                                            <div class="card-body1">
                                            <p>Pay via Stripe.</p>
                                            </div>
                                        </div>
                                </div>
                                    <div class="order_button">
                                        <button  type="submit">Place The Order</button>
                                    </div>
                                </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Checkout page section end-->



@endsection

@section('footer_js')
<script>
$(document).ready(function() {
$('#division_id').on('change', function() {
var type_id = $(this).val();
if(type_id) {
$.ajax({
url:'/find/district/by/divison/'+type_id,
type: "GET",
data : {"_token":"{{ csrf_token() }}"},
dataType: "json",
success:function(data) {
// console.log(data);
if(data){
$('#district_id').empty();
$('#district_id').focus;
$('#district_id').append('<option value="">-- Select Sub-Category --</option>');
$.each(data, function(key, value){
$('select[name="district_id"]').append('<option value="'+ value.id +'">' + value.name+ '</option>');
});
}
else{
$('#district_id').empty();
}
}
});
}else{
$('#district_id').empty();
}
});
});
</script>
<script>
$(document).ready(function() {
$('#district_id').on('change', function() {
var type_id = $(this).val();
if(type_id) {
$.ajax({
url:'/find/upazila/by/district/'+type_id,
type: "GET",
data : {"_token":"{{ csrf_token() }}"},
dataType: "json",
success:function(data) {
// console.log(data);
if(data){
$('#upazila_id').empty();
$('#upazila_id').focus;
$('#upazila_id').append('<option value="">-- Select Sub-Category --</option>');
$.each(data, function(key, value){
$('select[name="upazila_id"]').append('<option value="'+ value.id +'">' + value.name+ '</option>');
});
}
else{
$('#upazila_id').empty();
}
}
});
}else{
$('#upazila_id').empty();
}
});
});
</script>
@endsection
