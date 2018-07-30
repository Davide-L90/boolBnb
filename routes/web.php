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


Route::get('/', 'HomeController@index')->name('welcome');

Route::get('/apartments-results', 'ApartamentController@index')->name('apartments.results');
Route::get('/apartments-detail/{apartment_id}', 'ApartamentController@show')->name('apartments.detail');

//Send Message
Route::post('/apartments-detail/{apartment_id}/send-message','MessageController@sendMessage')->name('message.send');

Auth::routes();


Route::middleware('isLogged')->group(function (){
    Route::get('/home', 'UserPanelController@index')->name('home');
    Route::get('/user-logged-apartment-detail/{apartment_id}', 'UserPanelController@showApartmentDetail')->name('ownerApartmentDetails');
    Route::get('/home/inbox', 'UserPanelController@showInbox')->name('inbox.show');
    
    
    Route::resource('apartaments', 'ApartamentController');
    
    //Manage images
    /* Route::get('image/upload','ImageController@fileCreate'); */
    Route::post('/user-logged-apartment-detail/{apartment_id}/image-store','ImageController@fileStore')->name('image.store');
    Route::post('/user-logged-apartment-detail/image-delete','ImageController@fileDestroy')->name('image.delete');
    
    //Manage payment
    Route::get('/user-logged-apartment-detail/{apartment_id}/sponsor', 'AdvertisementController@index')->name('show.sponsors');
    Route::get('/user-logged-apartment-detail/{apartment_id}/sponsor/payment', 'AdvertisementController@tokenGen')->name('payment.tokenGen');
    Route::get('/user-logged-apartment-detail/{apartment_id}/sponsor/payment/process', 'AdvertisementController@process')->name('payment.process');
    

    
});


