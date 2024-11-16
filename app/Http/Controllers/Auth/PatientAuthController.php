<?php

namespace App\Http\Controllers\Auth;

use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PatientAuthController extends Controller
{
    // Mostrar el formulario de registro del paciente
    public function showRegisterForm()
    {
        return view('auth.patient_register');  // Asegúrate de crear esta vista
    }

    // Registrar un paciente
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:patients',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Crear el paciente y cifrar la contraseña
        Patient::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),  // Cifra la contraseña
            'role' => 'patient',
        ]);

        return redirect()->route('login')->with('message', 'Paciente registrado exitosamente!');
    }

    // Loguear a un paciente
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        $patient = Patient::where('email', $request->email)->first();

        if (!$patient || !Hash::check($request->password, $patient->password)) {
            return response()->json(['message' => 'Credenciales incorrectas'], 401);
        }

        $token = $patient->createToken('patient-token')->plainTextToken;

        return response()->json([
            'message' => 'Login exitoso',
            'token' => $token
        ]);
    }
}
