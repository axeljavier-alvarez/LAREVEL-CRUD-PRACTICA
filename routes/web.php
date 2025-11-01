<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;

Route::get('/', function () {
    return view('welcome');
});


/*
Route::get('/empleado', function(){
    return view('empleado.index');
});

Route::get('/empleado/create', [EmpleadoController::class, 'create']);
*/

// acceder a todas las rutas
Route::resource('empleado', controller: EmpleadoController::class);

