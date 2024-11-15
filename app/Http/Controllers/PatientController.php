<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    // Muestra la lista de pacientes
    public function index()
    {
        $patients = Patient::all();
        return view('patients.index', compact('patients'));
    }

    // Muestra el formulario para registrar un nuevo paciente
    public function create()
    {
        return view('patients.create');
    }

    // Guarda un nuevo paciente
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:patients,email',
            'phone' => 'required|string|max:20',
            'birth_date' => 'required|date',
        ]);

        Patient::create($validated);

        return redirect()->route('patients.index')->with('success', 'Patient created successfully.');
    }

    // Muestra los detalles de un paciente específico
    public function show(Patient $patient)
    {
        return view('patients.show', compact('patient'));
    }

    // Muestra el formulario para editar un paciente
    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    // Actualiza un paciente existente
    public function update(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:patients,email,' . $patient->id,
            'phone' => 'required|string|max:20',
            'birth_date' => 'required|date',
        ]);

        $patient->update($validated);

        return redirect()->route('patients.index')->with('success', 'Patient updated successfully.');
    }

    // Elimina un paciente
    public function destroy(Patient $patient)
    {
        $patient->delete();

        return redirect()->route('patients.index')->with('success', 'Patient deleted successfully.');
    }
}
