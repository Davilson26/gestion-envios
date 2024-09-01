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
            $table->string('peso');
            $table->string('alto');
            $table->string('ancho');
            $table->string('profundidad');
            $table->string('cantidad');
            $table->string('volumen');
            $table->string('valoru');
            $table->string('total');
            $table->string('unidad_peso');
            $table->string('unidad_medidas');
            $table->string('unidad_cantidades');
            $table->bigInteger('envio_id')->unsigned();
            $table->foreign('envio_id')
                ->references('id')
                ->on('envios')
                ->onDelete('cascade');
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
