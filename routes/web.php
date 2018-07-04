<?php

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

// Frontend
Route::get('/', 'IndexController@index')->name('index');
Route::get('/products/{id}', 'IndexController@SingleProduct')->name('products');

//cart
Route::post('/cart', 'CartController@ProcessCart')->name('cart');
Route::get('/cart', 'CartController@ShowCart')->name('cart.view');
Route::post('/cart-update', 'CartController@UpdateCart')->name('cart.update');
Route::get('/cart-update-increase/{rowId}/{qty}', 'CartController@UpdateCartIncrease')->name('cart.update.increase');
Route::get('/cart-update-decrease/{rowId}/{qty}', 'CartController@UpdateCartDecrease')->name('cart.update.decrease');
Route::get('/cart-delete/{rowId}', 'CartController@DeleteCart')->name('cart.delete');
Route::get('/clear-cart', 'CartController@ClearCart')->name('clear-cart');

//checkout
Route::get('/checkout', 'CheckoutController@index')->name('checkout.show');
Route::post('/user-update', 'CheckoutController@UserUpdate')->name('user.update');
Route::get('/shipping', 'CheckoutController@Shipping')->name('shipping');
Route::post('/save-shipping', 'CheckoutController@SaveShipping')->name('save.shipping');
Route::post('/place-order', 'CheckoutController@PlaceOrder')->name('place.order');
Route::post('/success', 'CheckoutController@Success')->name('payment.success');
Route::post('/fail', 'CheckoutController@Fail')->name('payment.fail');
Route::post('/cancel', 'CheckoutController@Cancel')->name('payment.cancel');


Route::get('/payment', 'CheckoutController@Payment')->name('payment');


Route::post('/payments/success', 'CheckoutController@Success');
Route::get('/payments/fails', function () {
	return 'fails';
});

// Users 
Route::get('/user-login', 'Auth\LoginController@index')->name('login.show');
Route::post('/sign-in', 'Auth\LoginController@SignIn')->name('sign_in');
Route::post('/user-register', 'Auth\LoginController@register')->name('user.register');
Route::get('/user-logout', 'Auth\LoginController@logout')->name('logout');




// Auth::routes();



Route::prefix('admin')->group(function (){
	Route::get('/login', 'Auth\AdminLoginController@ShowLoginForm')->name('admin.login');
	Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
	Route::get('/logout', 'AdminController@logout')->name('admin.logout');



	Route::get('/manage-order', 'OrderController@ManageOrder')->name('admin.manage.order');
	Route::get('/view-order/{id}', 'OrderController@ViewOrder')->name('admin.view.order');
	Route::get('/delete-order/{id}', 'OrderController@DeleteOrder')->name('admin.delete.order');

	// Category 

	Route::get('/manage-category', 'CategoryController@index')->name('admin.manage.category');
	Route::get('/add-category', 'CategoryController@create')->name('admin.add.category');
	Route::post('/save-category', 'CategoryController@store')->name('save-category');
	Route::get('/unpublish-category/{id}', 'CategoryController@unpublish')->name('unpublish-category');
	Route::get('/publish-category/{id}', 'CategoryController@publish')->name('publish-category');
	Route::get('/edit-category/{id}', 'CategoryController@edit')->name('edit-category');
	Route::post('/edit-category/{id}', 'CategoryController@update')->name('edit-category.submit');
	Route::get('/delete-category/{id}', 'CategoryController@destroy')->name('delete-category');

	//Brand
	Route::get('/manage-brand', 'BrandController@index')->name('manage-brand');
	Route::get('/add-brand', 'BrandController@create')->name('add-brand');
	Route::post('/save-brand', 'BrandController@store')->name('save-brand');
	Route::get('/edit-brand/{id}', 'BrandController@edit')->name('edit-brand');
	Route::post('/edit-brand/{id}', 'BrandController@update')->name('edit-brand.submit');
	Route::get('/delete-brand/{id}', 'BrandController@destroy')->name('delete-brand');


	//Products
	Route::get('/manage-product', 'ProductController@index')->name('manage-product');
	Route::get('/add-product', 'ProductController@create')->name('add-product');
	Route::post('/save-product', 'ProductController@store')->name('save-product');
	Route::get('/edit-product/{id}', 'ProductController@edit')->name('edit-product');
	Route::post('/edit-product/{id}', 'ProductController@update')->name('edit-product.submit');
	Route::get('/delete-product/{id}', 'ProductController@destroy')->name('delete-product');
	

	Route::get('/', 'AdminController@index')->name('admin.dashboard');
});
