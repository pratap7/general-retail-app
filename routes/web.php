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
Route::get('/forgot-password', 'PagesController@forgot_password');
Auth::routes();
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');

// Builder Routes
Route::resource('builders', 'BuildersController');
Route::get('/builder/display/{id}','BuildersController@display')->name('builder-display');
Route::get('/builder/generate-pdf/{id}','BuildersController@generatePDF')->name('generate-builder-pdf');
Route::get('/builder/review/{id}','BuildersController@review')->name('builder.review');
Route::post('/builder/sendEmail','BuildersController@sendEmail')->name('builder.sendEmail');
Route::get('/builder/sendMessage','BuildersController@sendMessage')->name('builder.send-sms');
Route::post('/builder/sendSMS','BuildersController@sendSMS')->name('builder.send-message');

// Plant Routes
Route::resource('plants', 'PlantsController');
Route::get('/plant/display/{id}','PlantsController@display')->name('plant-display');

// Order Routes
Route::resource('orders', 'OrdersController');
Route::get('/order/display/{id}','OrdersController@display')->name('order-display');
Route::get('/order/generate-pdf/{id}','OrdersController@generatePDF')->name('generate-pdf');
Route::get('/order/review/{id}','OrdersController@review')->name('order.review');
Route::post('/order/sendEmail','OrdersController@sendEmail')->name('order.sendEmail');

// Change Password Routes
Route::get('change-password', 'ChangePasswordController@index');
Route::post('change-password', 'ChangePasswordController@store')->name('change.password');

// Profile Update
Route::get('edit-profile', 'HomeController@profile')->name('edit-profile');
Route::post('update-profile', 'HomeController@updateProfile')->name('update.profile');

// Email Templates
Route::resource('email-templates', 'EmailTemplatesController');
Route::get('/email-template/display/{id}','EmailTemplatesController@display')->name('email-template');


Route::get('/test', 'TestController@sendSMS');

// Payment Routes
Route::resource('payments', 'PaymentsController');
Route::get('/payment/create/{id}','PaymentsController@createPayment')->name('do.payment');
Route::post('/payment/save','PaymentsController@save')->name('payment.save');
Route::post('/payment/update','PaymentsController@update')->name('payment.update');
Route::get('/payment/generate-pdf/{id}','PaymentsController@generatePDF')->name('payment-generate-pdf');
Route::post('/payment/sendEmail','PaymentsController@sendEmail')->name('payments.sendEmail');
Route::get('/payment/detail/{id}', 'PaymentsController@paymentDetail')->name('payment.detail');
Route::get('/payment/utilize/{id}', 'PaymentsController@utilize')->name('payment.utilize');
Route::get('/utilized-payments', 'PaymentsController@utilizedPayments')->name('payments.utilized');
Route::get('/pending-payments', 'PaymentsController@pendingPayments')->name('payments.pending');

// Statements Routes
Route::get('/statements-reports','StatementsController@index')->name('statements.reports');
Route::get('/statements-pdf/{builder}/{brand}','StatementsController@generatePDF')->name('statements.generatePDF');

// Dispatch Routes
Route::get('/dispatch-ambuja','DispatchController@ambujaReports')->name('dispatch.ambuja');
Route::post('/dispatch-save','DispatchController@save')->name('dispatch.save');
Route::post('/dispatch-update','DispatchController@update')->name('dispatch.update');
Route::get('/dispatch-mehta','DispatchController@mehtaReports')->name('dispatch.mehta');
Route::get('/dispatch-ambuja-pdf', 'DispatchController@ambujaPDF')->name('dispatch.ambuja.pdf');
Route::get('/dispatch-tmg-pdf', 'DispatchController@mehtaPDF')->name('dispatch.tmg.pdf');
Route::post('/dispatch/del/{id}', 'DispatchController@destroyReport')->name('dispatch-delete');
Route::get('dispatch/send-message/{id}','DispatchController@sendMessage')->name('dispatch.send-message');