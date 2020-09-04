<?php

use Illuminate\Support\Facades\Route;
use App\Category;


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


Route::get('/Company', function () {
    return view('Company');
});


/*-------------OrderController--------*/
Route::get('/Order', 'OrderController@Order');
Route::post('/Order', 'OrderController@MakeOrder')->name('MakeOrder');
Route::get('/Order/UpdateOrder', 'OrderController@editOrder')->name('EditOrder');
Route::post('/Order/SubOrder', 'OrderController@SubOrder')->name('SubOrder');



/*-------------AdminController--------*/
Route::get('/AdminList', 'AdminUserController@AdminList')->middleware(['auth', 'password.confirm']);
Route::delete('/AdminList', 'AdminUserController@RemoveUser')->name('RemoveUser');
Route::get('/AdminList/EditUser/{id}', 'AdminUserController@EditUser')->name('EditUser');
Route::post('/AdminList/UpdateUser/{id}', 'AdminUserController@UpdateUser')->name('UpdateUser');
Route::post('/AdminList/MakeAdmin', 'AdminUserController@MakeAdmin')->name('MakeAdmin');




/*-------------SendEmailController--------*/
Route::get('/contactUs', 'SendEmailController@Mail');
Route::post('/contactUs', 'SendEmailController@SendMail');


/*-------------CartController--------*/
Route::get('/Cart', 'CartController@Cart');
Route::post('/Cart/AddCart', 'CartController@AddCart')->name('AddCart');
Route::delete('/Cart/DeleteFromCart', 'CartController@RemoveCart')->name('RemoveCart');
Route::get('/Cart/ProductCart', 'CartController@ProductCart')->name('ProductCart');



/*-------------CategoryController--------*/
Route::post('/Category/AddCategory', 'CategoryController@AddCategory')->name('AddCategory');
Route::delete('/Category/DeleteCategory', 'CategoryController@DeleteCategory')->name('DeleteCategory');
Route::post('/Category/EditCategory', 'CategoryController@EditCategory')->name('EditCategory');


/*-------------ProductController--------*/

Route::get('/', 'ProductController@index');
Route::post('/Product/AddProduct', 'ProductController@store')->name('AddProduct');
Route::delete('/Product/delete', 'ProductController@destroy')->name('DeleteProduct');


Route::get('/Product/edit/{Id}', 'ProductController@edit')->name('EditProduct');
Route::post('/Product/edit/{Id}', 'ProductController@update')->name('UpdateProduct');
Route::get('/Product/details/{Id}', 'ProductController@details')->name('DetailsProduct');


Route::get('/Products', 'ProductController@ShowProducts')->name('Product');;
Route::get('/Products/{id}', 'ProductController@ShowFilterdProducts');


View::composer(['layouts.bars','AdminList','UpdateProduct'], function ($view) {
    $Category = Category::all(); 
    $view->with('Category',$Category);
});

Auth::routes();


