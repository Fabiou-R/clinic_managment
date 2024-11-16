<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    // Muestra la lista de doctores
    public function index()
    {
        $doctors = Doctor::all();
        return view('doctors.index', compact('doctors'));
    }

    // Muestra el formulario para registrar un nuevo doctor
    public function create()
    {
        return view('doctors.create'); 
    }

    // Guarda un nuevo doctor
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'available_hours' => 'required|string|max:255',
            'email' => 'required|email|unique:doctors,email',
            'password' => 'required|string|min:8',
        ]);


        $doctor = Doctor::create([
            'name' => $request->name,
            'specialty' => $request->specialty,
            'phone' => $request->phone,
            'available_hours' => $request->available_hours,
            'email' => $request->email,
            'password' => $request->password, 
        ]);
        dd($doctor); 

        // Asignar el rol de 'doctor'
        $doctor->assignRole('doctor');

        return response()->json($doctor, 201);
    }

    // Muestra los detalles de un doctor específico
    public function show(Doctor $doctor)
    {
        return view('doctors.show', compact('doctor'));
    }

    // Muestra el formulario para editar un doctor
    public function edit(Doctor $doctor)
    {
        return view('doctors.edit', compact('doctor'));
    }

    // Actualiza un doctor existente
    public function update(Request $request, Doctor $doctor)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'available_hours' => 'required|string|max:255',
        ]);

        $doctor->update($validated);

        return redirect()->route('doctors.index')->with('success', 'Doctor updated successfully.');
    }

    // Elimina un doctor
    public function destroy(Doctor $doctor)
    {
        $doctor->delete();

        return redirect()->route('doctors.index')->with('success', 'Doctor deleted successfully.');
    }
}
