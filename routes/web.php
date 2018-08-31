<?php
Route::get('/', function () {
    return view('welcome');
});
Route::get('/forget_password', function () {
    return view('forget_password');
});
Route::get('/resetpassword', function () {
    return view('reset_password');
});
Route::get('/dashboard', 'AccountController@index')->middleware('authenticated');

Route::get('/signup','listController@index');

Route::get('/contact_us', function () {
    return view('contact_us');
});

Route::get('/profile', function () {
    return view('profile');
})->middleware('authenticated');

Route::get('/edit_profile', function () {
    return view('edit_profile');
})->middleware('authenticated');

Route::get('/create_account', function () {
    return view('create_account');
})->middleware('authenticated');

Route::get('/history', 'AccountController@history')->middleware('authenticated');
//User Registration 
Route::resource('users', 'UserController');

Route::post('/periodicTransaction', 'AccountController@periodicUpdate')->middleware('authenticated');

//Open Account
Route::resource('accounts', 'AccountController')->middleware('authenticated');


//User Login 
Route::post('/userlogin', 'AccountController@UserLogin');

Route::get('/logout', 'LogoutController@getSignOut');

Route::post('/forgetpassword', 'LogoutController@sendEmail');

Route::post('/resetpassword', 'LogoutController@setPassword');

Route::post('graph_filter','AccountController@graphfilter')->middleware('authenticated');

Route::get('account_account_transfer', 'AccountController@accountName')->middleware('authenticated');

Route::get('with_in_account', 'AccountController@inAccountTransfer')->middleware('authenticated');

Route::get('periodic_transaction', 'AccountController@periodicTransaction')->middleware('authenticated');

Route::get('/graphs_data', 'AccountController@graphsdata')->middleware('authenticated');

Route::get('/account_setting', 'AccountController@account_setting')->middleware('authenticated');