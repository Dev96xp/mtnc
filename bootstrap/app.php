<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(

        // RUTAS ORIGINALES
        // web: __DIR__.'/../routes/web.php',
        // commands: __DIR__.'/../routes/console.php',
        // health: '/up',


        // RUTAS NUEVAS(Para VERSION 11 DE LARAVEL, este es el metodo de tener un control sobre las rutas)
        using: function (Illuminate\Routing\Router $router) {

            // $router->middleware('api')                   NO SE USA EN ESTE MOMENTO
            //     ->prefix('api')
            //     ->group(base_path('routes/api.php'));

            $router->middleware('web')
                ->group(base_path('routes/web.php'));


            // $router->middleware('web')                   NO SE USA EN ESTE MOMENTO
            //     ->name('admin.')    //Las ruta va a comenzar con (admin.)
            //     ->prefix('admin')
            //     ->group(base_path('routes/admin.php'));

        },

        commands: __DIR__ . '/../routes/console.php',
        health: '/up',

    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        // HabilitarTenancyForLivewire Part 4/4
        $middleware->group('universal', []);  // LO AGREGUE
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
