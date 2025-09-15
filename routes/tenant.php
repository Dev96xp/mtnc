<?php

declare(strict_types=1);

use App\Http\Controllers\Tenancy\Admin\BrandController;
use App\Http\Controllers\Tenancy\Admin\BussinessController;
use App\Http\Controllers\Tenancy\Admin\CategoryController;
use App\Http\Controllers\Tenancy\admin\HomeController;
use App\Http\Controllers\Tenancy\TaskController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use Illuminate\Support\Facades\Storage;
use Livewire\Volt\Volt;
use App\Http\Controllers\Tenancy\HomeController as TenancyHomeController;

/*
|--------------------------------------------------------------------------
| Tenant Routes;
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

// TODAS LAS RUTAS PARA LOS TENANTS VAN AQUI ADENTRO
Route::middleware([
    'web',
    // MASTER CLASS
    // a) Este middleware - Se encarga de la conection a la base de datos dependiendo del dominio
    // del inquilino conque se este trabajando
    InitializeTenancyByDomain::class,
    // b) Este middleware - Previeen el ingreso a rutas no autorizadas entre inquilinos y plataforma principal
    PreventAccessFromCentralDomains::class,
])->group(function () {

    // TENANT - HOME PAGE
    Route::resource('/', TenancyHomeController::class);   // NUEVO, OJO - con el nombre del controlador es un alias


    // GRUPO DE RUTAS, DONDE ES NECESARIO HACER LOGIN
    Route::middleware('auth')->group(function () {

        // TENANT - DASHBOARD
        // Dashboard, tan proto como se realiza el (log-in), entra aqui
        Route::get('dashboard', function () {
            return view('tenancy.welcome');         // Originalmente mostraba la vista dashboard pero ahora
                                                    // muestra la vista welcome otra vez, pero con el usuario
                                                    // autentificado (La pagina princial de un tenant)
        })->name('t-dashboard');  // OJO - Cambie el nombre de la ruta a t-profile para evitar conflicto con la ruta profile del central, COREJIR EN EL FUTURO


        // TENANT - TASKS
        Route::resource('tasks', TaskController::class);



        // TENANT - ######---- ADMIN ------######
        Route::get('/tadmin', [HomeController::class, 'index'])->name('adminx-home');
        Route::get('/logout', [HomeController::class, 'logout'])->name('adminx-logout');

        Route::get('/business', [BussinessController::class, 'index'])->name('business');
        Route::get('/category', [CategoryController::class, 'index'])->name('category');
        Route::get('/brand', [BrandController::class, 'index'])->name('brand');


        Route::view('profile', 'profile')->name('t-profile');
    });



    // Esta ruta se llama 'file', y se le pasa el path del archivo que se quiere descargar
    // y este retorna la direcion completa de la imagen a mostrar
    Route::get('/file/{path}', function ($path) {
        return response()->file(Storage::path($path));
    })->where('path', '.*')->name('file');


    // Esta rutas las copie de (routes/auth.php), aunque son iguales les di un nombre diferente
    // para evitar conflictos con las rutas del central, ya que ambas usan el mismo controlador de
    // localizadas en (routes/auth.php)
    Route::middleware('guest')->group(function () {
        Volt::route('register', 'pages.auth.register')
            ->name('t-register');

        Volt::route('login', 'pages.auth.login')
            ->name('t-login');
    });
});
