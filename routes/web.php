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
use App\User;
Route::get('/', [
    'uses' => function () {return view('welcome');},
    // 'role' => User::ROLE_ADMIN,
]);

Auth::routes();

Route::get('/home', [
    'uses' => 'HomeController@index',
    ]);

/**
 * Route of role admin or manager
 */
Route::get('/admin', [
    'uses' => 'AdminController@index',
    'role' => User::ROLE_ADMIN + User::ROLE_MANAGER,
]);


/**
 * Route of role Bar
 */
Route::get('/bar', [
    'uses' => 'BarController@index',
    'role' => User::ROLE_ADMIN + User::ROLE_MANAGER + User::ROLE_BAR,
]);


/**
 * Route of role Order
 */
Route::get('/order', [
    'uses' => 'OrderController@index',
    'role' => User::ROLE_ADMIN + User::ROLE_MANAGER + User::ROLE_ORDER,
]);


/**
 * Route of role Chef
 */
Route::get('/chef', [
    'uses' => 'ChefController@index',
    'role' => User::ROLE_ADMIN + User::ROLE_MANAGER + User::ROLE_CHEF,
]);
Route::resource('User/users', 'User\\UsersController');
Route::resource('User/users', 'User\\UsersController');
Route::resource('User/users', 'User\\UsersController');
Route::resource('Table/table', 'Table\\TableController');
Route::resource('Product/product', 'Product\\ProductController');
Route::resource('Category/category', 'Category\\CategoryController');
Route::resource('Order/order', 'Order\\OrderController');
Route::resource('OrderDetail/order-detail', 'OrderDetail\\OrderDetailController');