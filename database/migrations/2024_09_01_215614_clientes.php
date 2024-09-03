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
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
