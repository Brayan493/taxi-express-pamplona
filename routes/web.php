<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OperadoraController;
use App\Http\Controllers\ConductorController;
use Illuminate\Support\Facades\Route;

// RUTAS PÚBLICAS
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/nosotros', function () {
    return view('nosotros');
})->name('nosotros');

Route::get('/servicios', function () {
    return view('servicios');
})->name('servicios');

Route::get('/corporativo', function () {
    return view('corporativo');
})->name('corporativo');

// LOGIN
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

// RUTAS PROTEGIDAS
Route::middleware(['auth'])->group(function () {
    
    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout.get');
    
    // Admin
    Route::middleware(['checkRole:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/vehiculos', [AdminController::class, 'vehiculos'])->name('vehiculos');
        Route::get('/conductores', [AdminController::class, 'conductores'])->name('conductores');
        Route::get('/propietarios', [AdminController::class, 'propietarios'])->name('propietarios');
        Route::get('/alertas', [AdminController::class, 'alertas'])->name('alertas');
        Route::get('/solicitudes-cambio-ruta', [AdminController::class, 'solicitudesCambioRuta'])->name('solicitudes-cambio-ruta');
        Route::get('/tarifas-destino', [AdminController::class, 'tarifasDestino'])->name('tarifas-destino');
        Route::get('/mantenimiento-general', [AdminController::class, 'mantenimientoGeneral'])->name('mantenimiento-general');
    });
    
    // Operadora
    Route::middleware(['checkRole:operadora'])->prefix('operadora')->name('operadora.')->group(function () {
        // Rutas principales del dashboard
        Route::get('/dashboard', [OperadoraController::class, 'dashboard'])->name('dashboard');
        Route::get('/control-turnos', [OperadoraController::class, 'controlTurnos'])->name('control-turnos');
        Route::get('/turnos-obligatorios', [OperadoraController::class, 'turnosObligatorios'])->name('turnos-obligatorios');
        Route::get('/vehiculos', [OperadoraController::class, 'vehiculos'])->name('vehiculos');

        // Rutas de gestión de la Operadora (Añadidas)
        Route::get('/conductores', [OperadoraController::class, 'conductores'])->name('conductores');
        Route::get('/alertas', [OperadoraController::class, 'alertas'])->name('alertas');
        
        // ✅ Rutas de la nueva funcionalidad de cumplimiento
        Route::get('/cumplimiento-turnos', [OperadoraController::class, 'cumplimientoTurnos'])->name('cumplimiento-turnos');
        Route::get('/cumplimiento-turnos/{id}', [OperadoraController::class, 'detalleCumplimiento'])->name('detalle-cumplimiento');
    });
    
    // Conductores
    Route::middleware(['checkRole:conductor'])->prefix('conductor')->name('conductor.')->group(function () {
        Route::get('/dashboard', [ConductorController::class, 'dashboard'])->name('dashboard');
        Route::get('/mis-turnos', [ConductorController::class, 'misTurnos'])->name('mis-turnos');
        Route::get('/alertas', [ConductorController::class, 'alertas'])->name('alertas');
        Route::get('/conductores', [ConductorController::class, 'conductores'])->name('conductores');
        Route::get('/mantenimiento-general', [ConductorController::class, 'mantenimientoGeneral'])->name('mantenimiento-general');
        Route::get('/solicitudes-cambio-ruta', [ConductorController::class, 'solicitudesCambioRuta'])->name('solicitudes-cambio-ruta');
        Route::get('/tarifas', [ConductorController::class, 'tarifas'])->name('tarifas');
        Route::get('/vehiculos', [ConductorController::class, 'vehiculos'])->name('vehiculos');
    });
});