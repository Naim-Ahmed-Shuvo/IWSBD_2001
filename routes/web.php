<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {


//     return view('welcome');

// });

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('category/backend/page', 'CategoryController@category');
Route::get('form', 'CategoryController@form');
Route::get('table', 'CategoryController@table');
Route::post('new/category', 'CategoryController@addNewCategory');
Route::get('delete/category/{id}', 'CategoryController@deleteCategory');
Route::get('edit/category/{id}', 'CategoryController@editCategory');
Route::post('update/category', 'CategoryController@updateCategory');
Route::get('subcategory/backend/page', 'SubCategoryController@subCategory');
Route::post('new-sub/category', 'SubCategoryController@newsubCategory');
Route::get('delete/subcategory/{id}', 'SubCategoryController@delsubCategory');
Route::get('edit/subcategory/{id}', 'SubCategoryController@editdatesubCategory');
Route::post('update/subcategory', 'SubCategoryController@updatesubCategory');


Route::get('add/product', 'ProductCotroller@addProductpage');
Route::post('add/new/product', 'ProductCotroller@addnewProduct');
Route::get('view/product', 'ProductCotroller@viewProduct');
Route::get('/find/subcategory/by/category/{id}', 'ProductCotroller@subcategoryBycategory');
Route::get('edit/product/{id}', 'ProductCotroller@editProduct');
Route::post('update/product', 'ProductCotroller@updateProduct');
Route::get('delete/product/{id}', 'ProductCotroller@deleteProduct');

// contact
Route::get('backend/contact/us', 'ContactController@index');
Route::post('contact/submit', 'ContactController@contact_submit');


// slider

Route::get('add/slider', 'SliderController@addSlider');
Route::post('add_slider/details', 'SliderController@addSliderDetails');
Route::get('view/slider', 'SliderController@viewSlider');


// frontend

Route::get('/', 'FrontendController@index');
Route::get('shop', 'FrontendController@shop');
Route::get('contact/us', 'FrontendController@Contact');
Route::get('blog', 'FrontendController@Blog');


// cart

Route::post('add/to/cart', 'CartController@index');
Route::get('cart/delete/{id}', 'CartController@delete_cart');
Route::get('view/cart', 'CartController@view_cart');


// checkout
Route::get('/proceed/checkout', 'CheckoutController@proceedToCheckout');
Route::post('place_order', 'CheckoutController@place_order');


// stripe

Route::get('stripe', 'StripePaymentController@stripe');
Route::post('stripe', 'StripePaymentController@stripePost')->name('stripe.post');

//orders
Route::get('/pending_orders', 'OrderController@pending_orders');
Route::get('/confirm_order/{id}', 'OrderController@confirm_order');
Route::get('/decline_order/{id}', 'OrderController@decline_order');
Route::get('/complete_orders', 'OrderController@complete_orders');
Route::get('/view_order_details', 'OrderController@view_order_details');
Route::get('/decline_orders', 'OrderController@decline_orders');

//stuff management
Route::get('/manage_stuff', 'UserController@manage_stuff');
Route::post('/add_users', 'UserController@add_users');


//stuff profile
Route::get('/stuff_profile', 'StuffController@stuff_profile');
Route::post('/update_stuff_profile', 'StuffController@update_stuff_profile');


//shipping method
Route::get('/shipping_method', 'ShippingMethodController@shipping_method');
Route::post('/save_shipping_method', 'ShippingMethodController@save_shipping_method');
Route::get('/edit_shipping/{id}', 'ShippingMethodController@edit_shipping');
Route::post('/update_shipping_method', 'ShippingMethodController@update_shipping_method');
Route::get('/delete_shipping/{id}', 'ShippingMethodController@delete_shipping');
