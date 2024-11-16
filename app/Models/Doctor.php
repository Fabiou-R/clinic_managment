<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;

class Doctor extends Authenticatable implements AuthenticatableContract
{
    use Notifiable, HasRoles; 

    protected $fillable = ['name', 'specialty', 'available_hours', 'email', 'password'];

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
