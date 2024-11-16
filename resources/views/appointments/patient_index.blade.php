@extends('layouts.app')

@section('content')
    <h1>My Appointments</h1>

    @if($appointments->isEmpty())
        <p>You have no upcoming appointments.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Doctor</th>
                    <th>Date & Time</th>
                    <th>Reason</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->doctor->name }}</td>
                        <td>{{ $appointment->date_time }}</td>
                        <td>{{ $appointment->reason }}</td>
                        <td>{{ ucfirst($appointment->status) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
