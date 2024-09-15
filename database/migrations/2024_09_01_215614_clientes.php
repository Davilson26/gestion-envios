<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('cedula', 45)->nullable();
            $table->string('nombres', 45)->nullable();
            $table->string('apellidos', 45)->nullable();
            $table->string('telefono', 45)->nullable();
            $table->integer('estado')->default(1);
            $table->string('direccion', 45)->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('no action')->onUpdate('no action');
            $table->timestamps();
            $table->softDeletes();
        });

        
        // Insertar datos de prueba en la tabla clientes
        DB::table('clientes')->insert([
            [
                'cedula' => '123456789',
                'nombres' => 'Juan',
                'apellidos' => 'Pérez',
                'telefono' => '555-1234',
                'estado' => 1,
                'direccion' => 'Calle Falsa 123',
                'user_id' => 1, // Asegúrate de que exista un usuario con ID 1
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'cedula' => '987654321',
                'nombres' => 'María',
                'apellidos' => 'Gómez',
                'telefono' => '555-5678',
                'estado' => 1,
                'direccion' => 'Avenida Siempre Viva 742',
                'user_id' => 2, // Asegúrate de que exista un usuario con ID 2
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'cedula' => '456789123',
                'nombres' => 'Carlos',
                'apellidos' => 'Sánchez',
                'telefono' => '555-6789',
                'estado' => 1,
                'direccion' => 'Plaza Mayor 100',
                'user_id' => 3, // Asegúrate de que exista un usuario con ID 3
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
        Schema::dropIfExists('clientes');
    }
};
