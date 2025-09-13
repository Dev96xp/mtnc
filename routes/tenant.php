<?php

declare(strict_types=1);

use App\Http\Controllers\Tenancy\admin\HomeController;
use App\Http\Controllers\Tenancy\TaskController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Tenancy\UserController;

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
    // Pantalla principal de los inquilinos
    Route::get('/', function () {
        return view('tenancy.welcome');
    });

    // TENANT - PROFILE

    Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('t-profile');   // OJO - Cambie el nombre de la ruta a x.profile para evitar conflicto con la ruta profile del central, COREJIR EN EL FUTURO


    // GRUPO DE RUTAS, DONDE ES NECESARIO HACER LOGIN
    Route::middleware('auth')->group(function () {

        // TENANT - DASHBOARD
        // Dashboard, tan proto como se realiza el (log-in), entra aqui
        Route::get('dashboard', function () {
            //return view('tenancy.dashboard');     //ORIGINAL
            return view('tenancy.welcome');         // Originalmente mostraba la vista dashboard pero ahora
                                                    // muestra la vista welcome otra vez, pero con el usuario
                                                    // autentificado (La pagina princial de un tenant)
        })->name('t-dashboard');  // OJO - Cambie el nombre de la ruta a t-profile para evitar conflicto con la ruta profile del central, COREJIR EN EL FUTURO


        // TENANT - TASKS
        Route::resource('tasks', TaskController::class);

        // TENANT - ADMIN
        Route::get('/tadmin', [HomeController::class, 'index'])->name('adminx-home');
        Route::get('/logout', [HomeController::class, 'logout'])->name('adminx-logout');

    });


    // [ADMIN] - GRUPO DE RUTAS PARA - ADMINISTRATOR
    // Route::middleware('auth')->group(function () {
    //     Route::get('/admin-t', [HomeController::class, 'index'])->name('adminx-home');
    // })->name('admin-tenancy');


    // Esta ruta se llama 'file', y se le pasa el path del archivo que se quiere descargar
    // y este retorna la direcion completa de la imagen a mostrar
    Route::get('/file/{path}', function ($path) {
        return response()->file(Storage::path($path));
    })->where('path', '.*')->name('file');


    // Esto me ayuda a tener las rutas de autentificacion del sistema
    // localizadas en (routes/auth.php)

    //require __DIR__ . '/auth.php';      //Esto incluye las rutas de registro para autentificarnos

});
