<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\client\ClienteController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\admin\AdminController;

Route::get('/', [ClienteController::class, 'index'])->name('client.index');


Route::get('/sobreNosotros', function () {
    return view('client.sobreNosotros');
})->name('client.sobreNosotros');
Route::get('/miCuenta', function () {
    return view('client.miCuenta');
})->name('client.miCuenta');
/*Route::middleware(['auth', 'role:admin'])->get('/', function () {
    return 'Bienvenido admin';
});*/
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    Route::resource('categorias', App\Http\Controllers\admin\CategoriaController::class);
    Route::resource('niveles-higiene', App\Http\Controllers\admin\NivelHigieneController::class);
    Route::resource('rangos-precio', App\Http\Controllers\admin\RangoPrecioController::class);
    Route::resource('opciones-nutritivas', App\Http\Controllers\admin\OpcionNutritivaController::class);
    Route::resource('restaurantes', App\Http\Controllers\admin\RestauranteController::class);
    Route::resource('restaurantes-imagenes', App\Http\Controllers\admin\ImagenRestauranteController::class)->only(['index','create','store','destroy']);
});

//Route::get('/', function () {
    //return view('client.index');
//});




Route::prefix('admin')->middleware('auth')->group(function () {
    
    
    
    //Route::resource('imagenes-restaurantes', App\Http\Controllers\admin\ImagenRestauranteController::class);
});



// Rutas de autenticación
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    // rutas protegidas
});






//Ruta con parametros
/*Route::get('/recepcion/registradocumento/{id}/{a}', function ($id, $a){
    if($id == 1 && $a == 1){
        $respuesta = "Personas voladoras";
    }else{
        $respuesta = "Animales cojos";
    }
    return "El resultado es ".$respuesta;
});
*/