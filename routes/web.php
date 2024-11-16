<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\DoctorAuthController;
use App\Http\Controllers\Auth\PatientAuthController;
use App\Http\Controllers\AppointmentController;

// Redirigir a login si el usuario no está autenticado
Route::get('/', function () {
    return redirect()->route('login');  // Jetstream maneja esta ruta
});

// Rutas de login para doctores y pacientes
Route::post('doctor/login', [DoctorAuthController::class, 'login']);
Route::post('patient/login', [PatientAuthController::class, 'login']);

// Rutas de registro para doctores y pacientes
Route::get('doctor/register', [DoctorAuthController::class, 'showRegisterForm'])->name('doctor.register');
Route::post('doctor/register', [DoctorAuthController::class, 'register']);

Route::get('patient/register', [PatientAuthController::class, 'showRegisterForm'])->name('patient.register');
Route::post('patient/register', [PatientAuthController::class, 'register']);

// Rutas protegidas que solo pueden ser accedidas por usuarios autenticados
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');  // Vista del dashboard
    })->name('dashboard');

    // Ruta para crear una cita (solo para usuarios autenticados)
    Route::get('/appointments/create', function () {
        return view('create_appointment');  // Vista para crear una cita
    });

    // Ruta para guardar la cita
    Route::post('appointments', [AppointmentController::class, 'store']);  // Crear una cita
});
