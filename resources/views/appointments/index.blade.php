@extends('layouts.app')

@section('content')
    <h1>Appointments</h1>
    <a href="{{ route('appointments.create') }}">Create New Appointment</a>
    
    <!-- Add filters for searching appointments -->
    <form method="GET" action="{{ route('appointments.index') }}">
        <!-- Filter fields (date, specialty, reason) -->
        <button type="submit">Filter</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Patient</th>
                <th>Doctor</th>
                <th>Date & Time</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->patient->name }}</td>
                    <td>{{ $appointment->doctor->name }}</td>
                    <td>{{ $appointment->date_time }}</td>
                    <td>{{ $appointment->status }}</td>
                    <td>
                        <a href="{{ route('appointments.show', $appointment) }}">View</a>
                        <a href="{{ route('appointments.edit', $appointment) }}">Edit</a>
                        <form action="{{ route('appointments.destroy', $appointment) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
