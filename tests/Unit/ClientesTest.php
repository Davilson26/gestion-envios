<?php

namespace Tests\Unit;

// use Tests\TestCase;
use App\Models\Clientes;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as TestingTestCase;
use Illuminate\Support\Facades\Hash;

class ClientesControllerTest extends TestingTestCase
{
    use RefreshDatabase;
    #[\PHPUnit\Framework\Attributes\Test]
    /** @test */
    public function it_can_create_a_client()
    {
        $userData = [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => Hash::make('password123'),
            'rol_id' => 3,
        ];

        $clientData = [
            'cedula' => '123456789',
            'nombres' => 'John',
            'apellidos' => 'Doe',
            'telefono' => '555-555-5555',
            'direccion' => '123 Main St',
        ];

        $user = User::create($userData);
        $clientData['user_id'] = $user->id;

        $cliente = Clientes::create($clientData);

        # Verificar que el cliente fue creado correctamente
        $this->assertDatabaseHas('users', ['email' => 'johndoe@example.com']);
        $this->assertDatabaseHas('clientes', ['nombres' => 'John', 'apellidos' => 'Doe']);
    }

    public function it_can_update_a_client()
    {
        # Crear un cliente de ejemplo
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => Hash::make('password123'),
            'rol_id' => 3,
        ]);

        $cliente = Clientes::create([
            'cedula' => '123456789',
            'nombres' => 'John',
            'apellidos' => 'Doe',
            'telefono' => '555-555-5555',
            'direccion' => '123 Main St',
            'user_id' => $user->id,
        ]);

       // Actualizar los datos del cliente
        $updateData = [
            'nombres' => 'Jane',
            'apellidos' => 'Doe',
            'telefono' => '444-444-4444',
            'direccion' => '456 Another St',
        ];

        $cliente->update($updateData);

       // Verificar que los datos fueron actualizados correctamente
        $this->assertDatabaseHas('clientes', ['nombres' => 'Jane', 'telefono' => '444-444-4444']);
    }
    
    public function it_can_delete_a_client()
    {
       // Crear un cliente de ejemplo
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => Hash::make('password123'),
            'rol_id' => 3,
        ]);

        $cliente = Clientes::create([
            'cedula' => '123456789',
            'nombres' => 'John',
            'apellidos' => 'Doe',
            'telefono' => '555-555-5555',
            'direccion' => '123 Main St',
            'user_id' => $user->id,
        ]);

       // Eliminar el cliente
        $cliente->delete();

       // Verificar que el cliente fue eliminado
        $this->assertDatabaseMissing('clientes', ['cedula' => '123456789']);
        $this->assertDatabaseMissing('users', ['email' => 'johndoe@example.com']);
    }

    public function it_can_show_a_client()
    {
        // Crear un cliente de ejemplo
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => Hash::make('password123'),
            'rol_id' => 3,
        ]);

        $cliente = Clientes::create([
            'cedula' => '123456789',
            'nombres' => 'John',
            'apellidos' => 'Doe',
            'telefono' => '555-555-5555',
            'direccion' => '123 Main St',
            'user_id' => $user->id,
        ]);

        // Verificar que el cliente se puede mostrar
        $foundClient = Clientes::find($cliente->id);
        $this->assertEquals($foundClient->nombres, 'John');
        $this->assertEquals($foundClient->apellidos, 'Doe');
    }
}
