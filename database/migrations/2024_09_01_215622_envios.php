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
            $table->string('origen');
            $table->string('destino');
            $table->longText('descripcion');
            $table->string('codigo_envio');
            $table->integer('estado');

            $table->bigInteger('empleados_idempleados')->unsigned();
            $table->bigInteger('clientes_idremitente')->unsigned();
            $table->bigInteger('clientes_iddestinatario')->unsigned();

            $table->foreign('empleados_idempleados')
                ->references('id')
                ->on('empleados')
                ->onDelete('no action');

            $table->foreign('clientes_idremitente')
                ->references('id')
                ->on('clientes')
                ->onDelete('no action');

            $table->foreign('clientes_iddestinatario')
                ->references('id')
                ->on('clientes')
                ->onDelete('no action');

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
