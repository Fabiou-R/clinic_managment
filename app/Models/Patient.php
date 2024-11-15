<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'birth_date',
    ];

    // Relación: un Paciente tiene muchas Citas
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
