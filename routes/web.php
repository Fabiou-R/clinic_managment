<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\DoctorAuthController;
use App\Http\Controllers\Auth\PatientAuthController;
use App\Http\Controllers\AppointmentController;

// Redirigir a la vista para elegir el rol si el usuario no está autenticado
Route::get('/', function () {
    return view('auth.select_role');  // Vista para seleccionar si es doctor o paciente
})->name('role.select');

// Rutas de login para doctores y pacientes
Route::post('doctor/login', [DoctorAuthController::class, 'login'])->name('doctor.login');
Route::post('patient/login', [PatientAuthController::class, 'login'])->name('patient.login');

// Rutas de registro para doctores y pacientes
Route::get('doctor/register', [DoctorAuthController::class, 'showRegisterForm'])->name('doctor.register');
Route::post('doctor/register', [DoctorAuthController::class, 'register'])->name('doctor.register');

Route::get('patient/register', [PatientAuthController::class, 'showRegisterForm'])->name('patient.register');
Route::post('patient/register', [PatientAuthController::class, 'register'])->name('patient.register');

// Rutas protegidas que solo pueden ser accedidas por usuarios autenticados
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Ruta del dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');  // Vista del dashboard
    })->name('dashboard');
});

// Rutas protegidas para gestionar citas, accesibles solo para usuarios autenticados
Route::middleware('auth')->group(function () {
    // Doctor's appointments
    Route::get('/appointments/doctor', [AppointmentController::class, 'doctorIndex'])->name('appointments.doctor.index');
    Route::get('/appointments/create/doctor', [AppointmentController::class, 'createForDoctor'])->name('appointments.create_for_doctor');
    
    // Patient's appointments
    Route::get('/appointments/patient', [AppointmentController::class, 'patientIndex'])->name('appointments.patient.index');

    // Rutas generales para gestionar citas (CRUD)
    Route::resource('appointments', AppointmentController::class);
});

