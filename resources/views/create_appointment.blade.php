<!-- resources/views/create_appointment.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cita</title>
</head>
<body>
    <h1>Crear una Cita</h1>

    <form method="POST" action="{{ url('appointments') }}">
        @csrf
        <label for="doctor_id">Selecciona el Doctor:</label>
        <select name="doctor_id">
            <option value="1">Dr. Juan Pérez</option>
            <option value="2">Dra. Ana García</option>
        </select><br>

        <label for="patient_id">Selecciona el Paciente:</label>
        <select name="patient_id">
            <option value="1">Paciente 1</option>
            <option value="2">Paciente 2</option>
        </select><br>

        <label for="appointment_date">Fecha y Hora de la Cita:</label>
        <input type="datetime-local" name="appointment_date" required><br>

        <button type="submit">Crear Cita</button>
    </form>
</body>
</html>
