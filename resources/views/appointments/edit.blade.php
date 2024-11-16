@extends('layouts.app')

@section('content')
    <h1>Edit Appointment</h1>

    <form method="POST" action="{{ route('appointments.update', $appointment) }}">
        @csrf
        @method('PUT')

        <div>
            <label for="doctor_id">Doctor</label>
            <select name="doctor_id" id="doctor_id">
                @foreach ($doctors as $doctor)
                    <option value="{{ $doctor->id }}" {{ $doctor->id == $appointment->doctor_id ? 'selected' : '' }}>
                        {{ $doctor->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="patient_id">Patient</label>
            <select name="patient_id" id="patient_id">
                @foreach ($patients as $patient)
                    <option value="{{ $patient->id }}" {{ $patient->id == $appointment->patient_id ? 'selected' : '' }}>
                        {{ $patient->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="date_time">Date & Time</label>
            <input type="datetime-local" name="date_time" id="date_time" value="{{ $appointment->date_time }}" required>
        </div>

        <div>
            <label for="reason">Reason</label>
            <input type="text" name="reason" id="reason" value="{{ $appointment->reason }}" required>
        </div>

        <div>
            <label for="status">Status</label>
            <select name="status" id="status">
                <option value="scheduled" {{ $appointment->status == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                <option value="canceled" {{ $appointment->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                <option value="completed" {{ $appointment->status == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>

        <button type="submit">Save Changes</button>
    </form>
@endsection
