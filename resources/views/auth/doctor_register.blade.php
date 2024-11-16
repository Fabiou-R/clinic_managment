
<form method="POST" action="{{ route('doctor.register') }}">
    @csrf
    <label for="name">Nombre</label>
    <input type="text" id="name" name="name" required>

    <label for="email">Correo electrónico</label>
    <input type="email" id="email" name="email" required>

    <label for="specialty">Especialidad</label>
    <input type="text" id="specialty" name="specialty" required>

    <label for="phone">Teléfono</label>
    <input type="text" id="phone" name="phone" required>

    <label for="available_hours">Horas disponibles</label>
    <input type="text" id="available_hours" name="available_hours" required>

    <label for="password">Contraseña</label>
    <input type="password" id="password" name="password" required>

    <label for="password_confirmation">Confirmar Contraseña</label>
    <input type="password" id="password_confirmation" name="password_confirmation" required>

    <button type="submit">Registrar Doctor</button>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</form>
