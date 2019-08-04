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

//SandBox Section
Route::get('/sandbox/send/sms', function () {
    return view('sandbox.sms');
})->name("send_sms_sandbox");
Route::post('/sandbox/process/sms','SandBox\SmsController@processMessage')->name('process_sms_sandbox');



//Customers Web Route File

Route::get('/login', function () {
    return view('auth.customer.login');
})->name("login");

Route::get('/reset/account', function () {
    return view('auth.customer.reset_password');
})->name("reset_account");



Route::post('/login','Auth\AuthController@login')->name('process_login');
Route::get('/logout','Auth\AuthController@logout')->name('logout');

Route::post('/reset/account','Auth\AuthController@reset_account')->name('reset_account');
Route::get('/reset/password/setup','Auth\AuthController@reset_account')->name('password_setup');
Route::get('/reset/password/setup/{code}','Auth\AuthController@start_account_password');

Route::post('/set/password','Auth\AuthController@set_account_password')->name('set_password');



Route::group(array('middleware' => 'auth'), function(){

    Route::get('/dashboard','DashboardController@index');
    Route::get('/','DashboardController@index')->name('dashboard');

    //Bank Account Management
    Route::get('/accounts','BankAccountController@index')->name('accounts');
    Route::get('/account/transactions/{id}','BankAccountController@transactions')->name('account_history');
    Route::get('/transactions','BankAccountController@all_transactions')->name('all_transactions');
    
    //Cards Management
    Route::get('/cards','CardController@index')->name('cards');
    Route::get('/card/transactions/{id}','CardTransactionController@show')->name('card_transactions');
    
    //Profile Management
    Route::get('/profile','ProfileController@index')->name('profile');

    //Setting Management
    Route::get('/settings','SettingsController@index')->name('settings');
    Route::post('/settings','SettingsController@update')->name('update_settings');
    

    //Inbox Messages
    Route::get('/inbox','MessageController@index')->name('inbox');
    Route::get('/inbox/{id}','MessageController@show')->name('read_message');
    Route::post('/send/message','MessageController@store')->name('send_message');


});