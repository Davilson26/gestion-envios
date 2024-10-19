<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 45);
            $table->timestamps();
        });

        // Insertar roles de prueba
        DB::table('roles')->insert([
            ['nombre' => 'Administrador', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Empleado', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Cliente', 'created_at' => now(), 'updated_at' => now()],
        ]);

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 60);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->foreignId('rol_id')->constrained('roles')->onDelete('no action')->onUpdate('no action');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('users')->insert([
            [
                'name' => 'Juan Admin',
                'email' => 'juan.admin@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'), // Hashear el password
                'rol_id' => 1, // Rol de Administrador
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'María Empleado',
                'email' => 'maria.empleado@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'rol_id' => 2, // Rol de Empleado
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Carlos Cliente',
                'email' => 'carlos.cliente@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'rol_id' => 3, // Rol de Cliente
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Andrea Cliente',
                'email' => 'Andrea.cliente@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'rol_id' => 3, // Rol de Cliente
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
