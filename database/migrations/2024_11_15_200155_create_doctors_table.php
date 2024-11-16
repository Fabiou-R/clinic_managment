<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('specialty')->default('General'); // Establecer valor predeterminado sin 'change'
            $table->string('available_hours'); // Ejemplo: "Lunes a Viernes: 9am - 5pm"
            $table->string('role')->default('doctor'); // Rol predeterminado
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('doctors');
    }
}
