<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment System</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="{{ route('appointments.index') }}">Appointments</a></li>
                <li><a href="{{ route('appointments.create') }}">Create Appointment</a></li>
            </ul>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>
</body>
</html>
