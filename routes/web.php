<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductoController;


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

Route::get('/', function () {
    //return view('welcome');
    return 'Hola desde las rutas';
});


Route::get('/usuarios', function () {
    return 'Pagina principal de los usuarios';
});

Route::get('/usuarios/{nombre}/{id}', function ($nombre, $id) {
    return 'Nombre de ususario: '.$nombre.' con el ID: '.$id;
});

Route::get('/usuarios2/{nombre}/{id?}', function ($nombre, $id = null) {
    
    if($id)
    {
        return 'Nombre de ususario: '.$nombre.' con el ID: '.$id;
    } else {
        return 'Nombre de ususario: '.$nombre.' con el ID: NULO';
    }
    
});


Route::get('/usuarios3/{nombre}/{id?}', function ($nombre, $id = null) {
    
    if($id)
    {
        return 'Nombre de ususario: '.$nombre.' con el ID: '.$id;
    } else {
        return 'Nombre de ususario: '.$nombre.' con el ID: NULO';
    }
    
})->where(['nombre' => '[A-Za-z]+', 'id' => '[0-9]+']);




Route::get('/redirigirprueba', function () {
    return redirect()->route('prueba');
});

Route::get('/prueba', function () {
    return 'Pagina principal de Prueba';
});


Route::redirect('/reusuarios', '/usuarios');



Route::get('/productos', [ProductoController::class, 'index']);

Route::get('/productos/create', [ProductoController::class, 'create']);

Route::get('/productos/{id}', [ProductoController::class, 'show']);
