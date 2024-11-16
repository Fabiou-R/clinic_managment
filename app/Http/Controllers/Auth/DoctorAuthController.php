<?php

namespace App\Http\Controllers\Auth;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DoctorAuthController extends Controller
{
    // Mostrar el formulario de registro del doctor
    public function showRegisterForm()
    {
        return view('auth.doctor_register');  // Asegúrate de crear esta vista
    }

    // Registrar un doctor
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:doctors',
            'password' => 'required|string|min:8|confirmed',
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        // Crear el doctor y cifrar la contraseña
        $doctor = Doctor::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'doctor',
        ]);
    
        
        $doctor->assignRole('doctor');
    
        return redirect()->route('login')->with('message', 'Doctor registrado exitosamente!');
    }

    // Loguear a un doctor
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        $doctor = Doctor::where('email', $request->email)->first();

        if (!$doctor || !Hash::check($request->password, $doctor->password)) {
            return back()->withErrors(['email' => 'Credenciales incorrectas'])->withInput();
        }

        $token = $doctor->createToken('doctor-token')->plainTextToken;

        return response()->json([
            'message' => 'Login exitoso',
            'token' => $token
        ]);
    }

}
