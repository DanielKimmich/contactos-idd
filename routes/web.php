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

Route::get('/', function () {
    return view('welcome');
});


 // Ajax
Route::group(['middleware' => 'admin',
              'prefix' => 'ajax',
              'namespace' => 'Admin'
], function() {
    // Concat Phone
    Route::post('client/list/phones', ['as' => 'getClientPhones', 'uses' => 'ContactCrudController@getClientPhones']);
    Route::post('client/add/phone', ['as' => 'addClientPhone', 'uses' => 'ContactCrudController@addClientPhone']);
    Route::post('client/delete/phone', ['as' => 'deleteClientPhone', 'uses' => 'ContactCrudController@deleteClientPhone']);

 // Contact Email
    Route::post('client/list/emails', ['as' => 'getClientEmails', 'uses' => 'ClientEmailController@getClientEmails']);
    Route::post('client/add/email', ['as' => 'addClientEmail', 'uses' => 'ClientEmailController@addClientEmail']);
    Route::post('client/delete/email', ['as' => 'deleteClientEmail', 'uses' => 'ClientEmailController@deleteClientEmail']);

  // Contact Addresses
    Route::post('client/list/addresses', ['as' => 'getContactAddresses', 'uses' => 'ContactAddressController@getContactAddresses']);
    Route::post('client/add/address', ['as' => 'addContactAddress', 'uses' => 'ContactAddressController@addContactAddress']);
    Route::post('client/delete/address', ['as' => 'deleteContactAddress', 'uses' => 'ContactAddressController@deleteContactAddress']);
});

