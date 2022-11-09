<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin'], function () {
    Route::match(['get', 'post'],'/login', [App\Http\Controllers\Admin\LoginController::class, 'login'])->name('admin.login');
    Route::match(['get', 'post'],'/logout', [App\Http\Controllers\Admin\LoginController::class, 'login'])->name('admin.logout');

    Route::group(['middleware' => 'admin'], function () {
        Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.home');
        Route::post('/search', [App\Http\Controllers\Admin\SearchController::class, 'show'])->name('admin.search');
        Route::get('/servers/new', [App\Http\Controllers\Admin\ServersController::class, 'new_servers'])->name('admin.servers.new');
        Route::get('/services', [App\Http\Controllers\Admin\ServicesController::class, 'show'])->name('admin.services');
        Route::get('/payment', [App\Http\Controllers\Admin\PaymentController::class, 'show'])->name('admin.payment');

        Route::resource('servers', App\Http\Controllers\Admin\ServersController::class, ['names' => 'admin.servers']);
        Route::resource('news', App\Http\Controllers\Admin\NewsController::class, ['names' => 'admin.news']);
    });
});
