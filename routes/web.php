<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;

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

// Route::get('/', function () {
//     return view('home');
// })->name('home');





Route::get('/', [\App\Http\Controllers\OrderPixelController::class, 'getPixels'])->name('home');

Route::get('test3', [\App\Http\Controllers\OrderPixelController::class, 'test3']);

Route::post('/checkPlace', [\App\Http\Controllers\OrderPixelController::class, 'checkPixelsPlace']);

Route::get('/forgot-password', function () {
    return view('forgot-password');
})->name('password.request');


Route::post('/forgot-password', [\App\Http\Controllers\RegisterController::class, 'resetPassword'])->name('resetPassword');
Route::post('/reset-password', [\App\Http\Controllers\RegisterController::class, 'newPassword'])->name('password.update');

Route::get('/reset-password/{token}', function ($token) {
    return view('new-password', ['token' => $token]);
})->name('password.reset');

Route::get('/email/verify', function () {
    return view('verify-email');
})->middleware('auth')->name('verification.notice');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');





Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return view('verify-email', ['success_email' => '1']);
})->middleware(['auth', 'signed'])->name('verification.verify');


Route::get('/selectPixelMaps', function () {
    return view('selectPixelMaps');
})->name('selectPixelMaps');


//OrderPixels
Route::get('test', [\App\Http\Controllers\OrderPixelController::class, 'test']);
Route::get('selectPixelMaps', [\App\Http\Controllers\OrderPixelController::class, 'selectPixelMaps']);
Route::get('resizeImage', [\App\Http\Controllers\OrderPixelController::class, 'resizeImage']);
Route::post('resizeImagePost', [\App\Http\Controllers\OrderPixelController::class, 'resizeImagePost'])->name('resizeImagePost');
Route::post('OrderPixels', [\App\Http\Controllers\OrderPixelController::class, 'OrderPixels'])->name('OrderPixels');
Route::post('pay', [\App\Http\Controllers\OrderPixelController::class, 'getPaymendLink'])->name('getPaymendLink');

Route::post('responsePay', [\App\Http\Controllers\OrderPixelController::class, 'responsePay'])->name('responsePay');



Route::name('user.')->group(function() {
    

    
    Route::middleware('verified')->group(function() {
        Route::view('/selectpixel', 'select_pixel')->middleware('auth')->name('selectpixel');
    });

    Route::get('/login', function() {
        if(Auth::check()) {
            return redirect(route('home'));
        }
        return view('login');
    })->name('login');

    Route::post('/login', [\App\Http\Controllers\LoginController::class, 'login']);

    Route::get('/registration', function() {
        if(Auth::check()) {
            return redirect('selectpixel');
        }
        return view('registration');
    })->name('registration');

    Route::get('/logout', function() {
        Auth::logout();
        return redirect('/');
    })->name('logout');
    

    Route::post('/registration', [\App\Http\Controllers\RegisterController::class, 'save']);
    
    

    

    

});