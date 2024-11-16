@extends('layouts.app')

@section('content')
    <h1>Schedule a New Appointment</h1>

    <form action="{{ route('appointments.store') }}" method="POST">
        @csrf
        <label for="patient_id">Patient:</label>
        <select name="patient_id" id="patient_id">
            @foreach($patients as $patient)
                <option value="{{ $patient->id }}">{{ $patient->name }}</option>
            @endforeach
        </select>

        <label for="date_time">Date and Time:</label>
        <input type="datetime-local" name="date_time" id="date_time" required>

        <label for="reason">Reason:</label>
        <input type="text" name="reason" id="reason" required>

        <button type="submit">Schedule Appointment</button>
    </form>
@endsection
