<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('usuarios', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('id_empleado')->unique(); // Clave foránea a empleados
        $table->string('rfc', 20)->unique();
        $table->string('password');
        $table->timestamps();

        $table->foreign('id_empleado')->references('id_empleado')->on('empleados')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
