<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id('id_empleado');
            $table->integer('tipo_empleado')->nullable();
            $table->string('nombres', 255)->nullable();
            $table->string('clave', 50)->nullable();
            $table->string('rfc', 20)->nullable();
            $table->string('puesto', 100)->nullable();
            $table->string('email', 255)->nullable();
            $table->tinyInteger('estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
