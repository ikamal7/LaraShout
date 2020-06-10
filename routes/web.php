<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


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



Auth::routes();


Route::get( '/', 'HomeController@index' )->name( 'home' );
Route::get( '/home', 'WelcomeController@index' );
Route::get( '/shout', [HomeController::class, 'shoutHome'] )->name( 'shout' );
Route::get('/profile', [HomeController::class, 'profile'])->name('shout.profile');
Route::get('/profile/edit', [HomeController::class, 'profileEdit'])->name('shout.profileEdit');
Route::get( '/shout/{nickname}', [HomeController::class, 'publicTimeline'] )->name( 'shout.public' );
Route::get( '/shout/addfriend/{friendID}', [HomeController::class, 'addFriend'] )->name( 'shout.addfriend' );
Route::get( '/shout/unfriend/{friendID}', [HomeController::class, 'unfriend'] )->name( 'shout.unfriend' );

// Post routes
Route::post( '/savestatus', [HomeController::class, 'saveStatus'] )->name( 'shout.save' );
Route::post('/saveprofile', [HomeController::class, 'saveProfile'])->name('shout.saveprofile');

