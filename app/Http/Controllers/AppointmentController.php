<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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
        // Validar la entrada
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'patient_id' => 'required|exists:patients,id',
            'date_time' => 'required|date|after:now',
            'reason' => 'required|string',
            'status' => 'required|in:scheduled,canceled,completed',
        ]);

        // Verificar que no haya citas para el mismo doctor en el mismo horario
        $existingAppointment = Appointment::where('doctor_id', $validated['doctor_id'])
                                          ->where('date_time', $validated['date_time'])
                                          ->first();

        if ($existingAppointment) {
            throw ValidationException::withMessages([
                'date_time' => 'Este horario ya está ocupado por otra cita.'
            ]);
        }

        // Crear la cita
        Appointment::create($validated);

        // Actualizar la disponibilidad del doctor
        $this->updateDoctorAvailability($validated['doctor_id'], $validated['date_time']);

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
        // Validación de la cita
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'patient_id' => 'required|exists:patients,id',
            'date_time' => 'required|date|after:now',
            'reason' => 'required|string',
            'status' => 'required|in:scheduled,canceled,completed',
        ]);

        // Verificar que no haya citas para el mismo doctor en el mismo horario (si la fecha ha cambiado)
        if ($appointment->doctor_id != $validated['doctor_id'] || $appointment->date_time != $validated['date_time']) {
            $existingAppointment = Appointment::where('doctor_id', $validated['doctor_id'])
                                              ->where('date_time', $validated['date_time'])
                                              ->first();

            if ($existingAppointment) {
                throw ValidationException::withMessages([
                    'date_time' => 'Este horario ya está ocupado por otra cita.'
                ]);
            }
        }

        // Actualizamos la cita
        $appointment->update($validated);

        // Actualizar la disponibilidad del doctor
        $this->updateDoctorAvailability($validated['doctor_id'], $validated['date_time']);

        return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully.');
    }

    // Elimina una cita
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully.');
    }

    // Método para actualizar la disponibilidad del doctor
    private function updateDoctorAvailability($doctorId, $appointmentDate)
    {
        $doctor = Doctor::findOrFail($doctorId);
        // Suponiendo que en 'available_hours' guardas los horarios disponibles, puedes modificarlos según tu lógica
        $doctor->available_hours = $this->updateAvailability($doctor->available_hours, $appointmentDate);
        $doctor->save();
    }

    // Método que puede modificar la disponibilidad según cómo se maneje
    private function updateAvailability($availableHours, $appointmentDate)
    {
        // Si la disponibilidad está almacenada como una cadena de texto con horas disponibles, puedes eliminar el horario reservado
        return str_replace($appointmentDate, '', $availableHours);  // Este es solo un ejemplo
    }
}
