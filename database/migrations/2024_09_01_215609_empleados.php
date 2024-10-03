<?php

use Illuminate\Support\Facades\DB;
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
            $table->id();
            $table->string('cedula', 45);
            $table->string('nombres', 45);
            $table->string('apellidos', 45);
            $table->string('cargo', 45);
            $table->foreignId('user_id')
                    ->constrained('users')
                    ->onDelete('no action')
                    ->onUpdate('no action');
            $table->timestamps();
            $table->softDeletes();
        });

        // Insertar datos de prueba en la tabla empleado
        DB::table('empleados')->insert([
            [
                'cedula' => '54321',
                'nombres' => 'María',
                'apellidos' => 'Empleado',
                'cargo' => 'empleado',
                'user_id' => 2, // Asegúrate de que exista un usuario con ID 2
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
