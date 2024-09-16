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
        Schema::create('envios', function (Blueprint $table) {
            $table->id();
            $table->string('origen', 45);
            $table->string('destino', 45);
            $table->longText('descripcion');
            $table->string('codigo_envio', 45)->nullable();
            $table->integer('estado');
            $table->foreignId('empleados_idempleados')->default(1)->constrained('empleados');
            $table->foreignId('clientes_idremitente')->default(12)->constrained('empleados');
            $table->foreignId('clientes_iddestinatario')->default(112)->constrained('empleados');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('envios');
    }
};
