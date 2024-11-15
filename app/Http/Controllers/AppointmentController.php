<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    // Muestra una lista de citas
    public function index()
    {
        $appointments = Appointment::with(['doctor', 'patient'])->get();
        return view('appointments.index', compact('appointments'));
    }

    // Muestra el formulario para crear una nueva cita
    public function create()
    {
        $doctors = Doctor::all();
        $patients = Patient::all();
        return view('appointments.create', compact('doctors', 'patients'));
    }

    // Guarda una nueva cita
    public function store(Request $request)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'patient_id' => 'required|exists:patients,id',
            'date_time' => 'required|date|after:now',
            'reason' => 'required|string',
            'status' => 'required|in:scheduled,canceled,completed',
        ]);

        Appointment::create($validated);
        return redirect()->route('appointments.index')->with('success', 'Appointment created successfully.');
    }

    // Muestra una cita específica
    public function show(Appointment $appointment)
    {
        return view('appointments.show', compact('appointment'));
    }

    // Muestra el formulario para editar una cita
    public function edit(Appointment $appointment)
    {
        $doctors = Doctor::all();
        $patients = Patient::all();
        return view('appointments.edit', compact('appointment', 'doctors', 'patients'));
    }

    // Actualiza una cita
    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'patient_id' => 'required|exists:patients,id',
            'date_time' => 'required|date|after:now',
            'reason' => 'required|string',
            'status' => 'required|in:scheduled,canceled,completed',
        ]);

        $appointment->update($validated);
        return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully.');
    }

    // Elimina una cita
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully.');
    }
}
