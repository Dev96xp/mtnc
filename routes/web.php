<?php

use App\Http\Controllers\Central\admin\HomeController;
use App\Http\Controllers\Tenancy\UserController;
use App\Http\Controllers\TenantController;
use Illuminate\Support\Facades\Route;


// routes/web.php, api.php or any other central route files you have

foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {


        Route::view('/', 'welcome')->name('home');
        //Route::get('/', HomeController::class)->name('home');

        Route::view('dashboard', 'dashboard')
            ->middleware(['auth', 'verified'])
            ->name('dashboard');

        Route::view('profile', 'profile')
            ->middleware(['auth'])
            ->name('profile');

        Route::middleware('auth')->group(function () {
            Route::resource('tenants', TenantController::class)->except('show');
        });


            // [ADMIN] - GRUPO DE RUTAS PARA - ADMINISTRATOR
    Route::middleware('auth')->group(function () {
        Route::get('/admin', [HomeController::class, 'index'])->name('admin-central');
    });

        require __DIR__ . '/auth.php';
    });
}
