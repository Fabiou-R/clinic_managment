<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'specialty',
        'phone',
        'available_hours',
    ];

    // Relación: un Doctor tiene muchas Citas
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
