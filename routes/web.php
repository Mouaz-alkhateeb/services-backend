<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


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
Route::get('/','FrontController@GetTemp');
Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/register', function () {
    return view('auth.register');
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'AdminController@index')->name('dashboard');
Route::get('/landing', 'AdminController@index2')->name('landing');
Route::get('/auth/redirect/{provider}','Auth\SocialiteController@redirect');
Route::get('/auth/callback/{provider}','Auth\SocialiteController@callback');
Route::get('/chat', 'HomeController@index2')->name('chat');
Route::get('/user', 'UserController@index2')->name('user')->middleware('PreventBackHistory');
Route::get('/admin', 'AdminController@index')->name('admin')->middleware('PreventBackHistory');
Route::get('/auth/redirect/{provider}','Auth\SocialiteController@redirect');
Route::get('/auth/callback/{provider}','Auth\SocialiteController@callback');

Route::resource('sections', 'SectionsController');
Route::get('/subsections/{id}', 'SectionsController@getSubSections');
Route::resource('services', 'ServicesController');
Route::get('/ServicesSubSections/{id}', 'ServicesController@getServicesSubSections');
Route::get('/details_service/{id}', 'ServicesController@show');
Route::get('/approval/{id}', 'AdminController@approval');
Route::get('/cancel/{id}', 'AdminController@cancel');
Route::resource('orders','OrdersController');
Route::get('/section/{id}', 'OrdersController@getservices');
Route::get('/details_order/{id}', 'OrdersController@show');
Route::get('view_file/{order_number}/{file_name}', 'OrdersController@open_file');
Route::get('download/{order_number}/{file_name}', 'OrdersController@download_file');
Route::post('delete_file', 'OrdersController@destroyfile')->name('delete_file');
Route::resource('OrderAttachments', 'AttachmentsOrderController');
Route::get('/edit_order/{id}', 'OrdersController@edit');
Route::get('/status_show/{id}', 'OrdersController@status_show')->name('status_show');
Route::post('/status_update/{id}', 'OrdersController@status_update')->name('status_update');
Route::resource('Archive', 'ArchiveOrderController');
Route::get('/Fullfilled_Orders', 'OrdersController@Fullfilled_Orders');
Route::get('/Partially_Fullfilled_Orders', 'OrdersController@Partially_Fullfilled_Orders');
Route::get('/UnFullfilled_Orders', 'OrdersController@UnFullfilled_Orders');
Route::get('export_orders', 'OrdersController@export');
Route::get('MarkAsReadAll', 'ServicesController@MarkAsReadAll');
Route::get('orders_report', 'OrdersReportController@index'); 
Route::post('search_orders', 'OrdersReportController@search_orders');   
Route::get('profits_report', 'ProfitsReportController@index');   
Route::post('search_profits', 'ProfitsReportController@search_profits');   
Route::get('customers_report', 'CustomersReportController@index'); 
Route::post('search_customers', 'CustomersReportController@search_customers'); 
Route::get('/ApprovalOrder/{id}', 'OrdersController@ApprovalOrder');
Route::get('/CancelOrder/{id}', 'OrdersController@CancelOrder');
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
   
    });
Route::resource('messagesBox','ContactController');
Route::resource('contacts','ContactController');
Route::post('contacts_form', 'ContactController@store'); 
Route::get('/message_details/{id}', 'ContactController@show');

Route::get('/{page}', 'AdminController@index');
