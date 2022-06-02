<?php

use Illuminate\Support\Facades\Route;


//Route::get('login', [\App\Http\Controllers\Admin\AuthController::class, 'index'])->name('admin.login');



    Route::get('/login', function () {
        return view('/admin/login');
    })->name('admin.login');

    
    Route::post('login', [\App\Http\Controllers\Admin\AuthController::class, 'login']);
    
    Route::middleware('auth:admin')->group(function() {
        Route::get('orders', [\App\Http\Controllers\Admin\OrdersController::class, 'getListOrders'])->name('admin.orders');
        Route::get('imagine', [\App\Http\Controllers\Admin\ScreenshotController::class, 'getAllScreensot'])->name('admin.screenshot');
    });
    /*


Route::middleware('auth:admin')->group(function() {
    Route::get('dashboard', function () {
        return view('admin/dashboard');
    })->name('admin.dashboard');

    Route::get('users', [UsersController::class, 'users'])->name('users-data');
    Route::get('group', [GroupController::class, 'group'])->name('group-data');
    Route::get('/group/edit/{id}', [GroupController::class, 'groupEdit'])->name('group-edit-data');
    Route::get('/group/delete/{id}', [GroupController::class, 'delete'])->name('group-delete-data');

    Route::get('admin/group', [GroupController::class, 'group'])->name('group-data');


    Route::get('group/new', function() {
        return view('admin/create_group');
    })->name('admin.groupnew');



    Route::get('users/new', [GroupController::class, 'groupListForUser'])->name('admin.users-create');
    Route::post('users/new', [\App\Http\Controllers\Admin\NewUser::class, 'create']);



    Route::post('group/new', [\App\Http\Controllers\Admin\GroupController::class, 'groupCreate']);
    Route::post('group/edit', [\App\Http\Controllers\Admin\GroupController::class, 'groupUpdate'])->name('groupUpdate');


});

Route::get('test', [\App\Http\Controllers\Admin\NewUser::class, 'testing']);










*/

// Route::post('admin/login', [\App\Http\Controllers\Admin\AuthController::class, 'login']);



