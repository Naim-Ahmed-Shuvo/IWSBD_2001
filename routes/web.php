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

Route::get('home', 'HomeController@index')->name('home');
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