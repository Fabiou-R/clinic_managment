@extends('layouts.app')

@section('content')
    <h1>My Appointments</h1>

    @if($appointments->isEmpty())
        <p>No appointments scheduled for you.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Patient</th>
                    <th>Date & Time</th>
                    <th>Reason</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->patient->name }}</td>
                        <td>{{ $appointment->date_time }}</td>
                        <td>{{ $appointment->reason }}</td>
                        <td>{{ ucfirst($appointment->status) }}</td>
                        <td>
                            <a href="{{ route('appointments.show', $appointment->id) }}">View</a> | 
                            <a href="{{ route('appointments.edit', $appointment->id) }}">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
