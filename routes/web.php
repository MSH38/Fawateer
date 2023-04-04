<?php

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

Route::get('/', function () {
    return view('auth.login');
});
// Route::get('/', function () {
//     return view('index');
// });


Auth::routes();
// Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('invoices', 'InvoicesController');
Route::resource('sections', 'SectionController');
Route::resource('products', 'ProductsController');
// Route::post('/invoices/invoices_details/store','InvoicesAttachmentsController@store')->name('Invoices_details.store');
Route::resource('InvoiceAttachments', 'InvoicesAttachmentsController');
Route::resource('Archive', 'InvoiceArchiveController');


Route::get('/section/{id}', 'InvoicesController@getproducts');
Route::get('/InvoicesDetails/{id}', 'InvoicesDetailsController@edit');

Route::get('/View_file/{invoice_number}/{file_name}', 'InvoicesDetailsController@open_file');
Route::get('download/{invoice_number}/{file_name}', 'InvoicesDetailsController@get_file');
Route::post('/delete_file', 'InvoicesDetailsController@destroy')->name('delete_file');

Route::get('/edit_invoice/{id}', 'InvoicesController@edit');
Route::get('/Status_show/{id}', 'InvoicesController@show')->name('Status_show');
Route::post('/Status_Update/{id}', 'InvoicesController@Status_Update')->name('Status_Update');

Route::get('Invoice_Paid','InvoicesController@Invoice_Paid');
Route::get('Invoice_UnPaid','InvoicesController@Invoice_UnPaid');
Route::get('Invoice_Partial','InvoicesController@Invoice_Partial');
Route::get('/print_invoice/{id}', 'InvoicesController@print_invoice');

Route::get('/export_invoices', 'InvoicesController@export');
Route::get('/{page}', 'AdminController@index');
