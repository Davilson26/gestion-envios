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
        Schema::create('envios_detalles', function (Blueprint $table) {
            $table->id();
            $table->double('peso')->nullable();
            $table->double('alto')->nullable();
            $table->double('ancho')->nullable();
            $table->double('profundidad')->nullable();
            $table->double('cantidad')->nullable();
            $table->double('volumen')->nullable();
            $table->double('valor_unidad')->nullable();
            $table->double('valor_total');
            $table->string('unidad_peso', 45)->nullable();
            $table->string('unidad_medidas', 45)->nullable();
            $table->string('unidad_cantidades', 45)->nullable();
            $table->foreignId('envios_idenvios')->constrained('envios')->onDelete('no action')->onUpdate('no action');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('envios_detalles');
    }
};
