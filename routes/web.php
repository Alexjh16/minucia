<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PiezaController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\BloqueController;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Rutas resource estándar
    Route::get('/piezas', [PiezaController::class, 'index'])->name('piezas.index');
    Route::get('/piezas/create', [PiezaController::class, 'create'])->name('piezas.create');
    Route::post('/piezas', [PiezaController::class, 'store'])->name('piezas.store');
    Route::get('/piezas/{pieza}/edit', [PiezaController::class, 'edit'])->name('piezas.edit');
    Route::put('/piezas/{pieza}', [PiezaController::class, 'update'])->name('piezas.update');
    Route::delete('/piezas/{pieza}', [PiezaController::class, 'destroy'])->name('piezas.destroy');

    // Métodos personalizados
    Route::get('/piezas/graficos', [PiezaController::class, 'graficos'])->name('piezas.graficos');
    Route::get('/piezas/change-state', [PiezaController::class, 'changeState'])->name('piezas.changeState');

    //ruta para los graficos
    Route::resource('proyectos', ProyectoController::class);
    Route::resource('bloques', BloqueController::class);
});

require __DIR__.'/auth.php';
