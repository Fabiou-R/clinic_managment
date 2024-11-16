@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Selecciona tu rol</h2>
        <div class="row">
            <div class="col-md-6">
                <a href="{{ route('doctor.register') }}" class="btn btn-primary btn-block">Soy Doctor</a>
            </div>
            <div class="col-md-6">
                <a href="{{ route('patient.register') }}" class="btn btn-secondary btn-block">Soy Paciente</a>
            </div>
        </div>
    </div>
@endsection
