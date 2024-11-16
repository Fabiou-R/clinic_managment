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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:patients,email',
            'phone' => 'required|string|max:15',
            'birth_date' => 'required|date',
            'password' => 'required|string|min:8',
        ]);

        $patient = Patient::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'birth_date' => $request->birth_date,
            'password' => $request->password,
        ]);

        // Asignar el rol
        $patient->assignRole('patient');

        return response()->json($patient, 201);
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
