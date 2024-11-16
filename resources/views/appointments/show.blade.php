@extends('layouts.app')

@section('content')
    <h1>Appointment Details</h1>

    <p><strong>Patient:</strong> {{ $appointment->patient->name }}</p>
    <p><strong>Doctor:</strong> {{ $appointment->doctor->name }}</p>
    <p><strong>Date & Time:</strong> {{ $appointment->date_time }}</p>
    <p><strong>Reason:</strong> {{ $appointment->reason }}</p>
    <p><strong>Status:</strong> {{ $appointment->status }}</p>

    <a href="{{ route('appointments.index') }}">Back to Appointments</a>
@endsection
