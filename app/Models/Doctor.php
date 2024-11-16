<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Doctor extends Authenticatable implements AuthenticatableContract
{
    use Notifiable;

    protected $fillable = ['name', 'specialty', 'phone', 'available_hours', 'email', 'password'];

    // Cifra la contraseña antes de guardarla
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    // Relación con citas
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
