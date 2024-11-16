@extends('layouts.app')

@section('content')
    <h1>Create Appointment</h1>

    <form method="POST" action="{{ route('appointments.store') }}">
        @csrf

        <div>
            <label for="doctor_id">Doctor</label>
            <select name="doctor_id" id="doctor_id">
                @foreach ($doctors as $doctor)
                    <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="patient_id">Patient</label>
            <select name="patient_id" id="patient_id">
                @foreach ($patients as $patient)
                    <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="date_time">Date & Time</label>
            <input type="datetime-local" name="date_time" id="date_time" required>
        </div>

        <div>
            <label for="reason">Reason</label>
            <input type="text" name="reason" id="reason" required>
        </div>

        <div>
            <label for="status">Status</label>
            <select name="status" id="status">
                <option value="scheduled">Scheduled</option>
                <option value="canceled">Canceled</option>
                <option value="completed">Completed</option>
            </select>
        </div>

        <button type="submit">Save</button>
    </form>
@endsection
