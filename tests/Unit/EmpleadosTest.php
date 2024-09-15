<?php

namespace Tests\Unit;

//  use Tests\TestCase;
use App\Models\Empleados;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as TestingTestCase;
use Illuminate\Support\Facades\Hash;

class EmpleadosTest extends TestingTestCase
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

        $empleData = [
            'cedula' => '123456789',
            'nombres' => 'John',
            'apellidos' => 'Doe',
            'cargo' => 'empleado'
        ];

        $user = User::create($userData);
        $empleData['user_id'] = $user->id;

        $cliente = Empleados::create($empleData);

        # Verificar que el cliente fue creado correctamente
        $this->assertDatabaseHas('users', ['email' => 'johndoe@example.com']);
        $this->assertDatabaseHas('Empleados', ['nombres' => 'John', 'apellidos' => 'Doe']);
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

        $empleado = Empleados::create([
            'cedula' => '123456789',
            'nombres' => 'John',
            'apellidos' => 'Doe',
            'cargo' => 'empleado',
            'user_id' => $user->id,
        ]);

       // Actualizar los datos del cliente
        $updateData = [
            'nombres' => 'Jane',
            'apellidos' => 'Doe',
            'cargo' => 'empleado',
        ];

        $empleado->update($updateData);

       // Verificar que los datos fueron actualizados correctamente
        $this->assertDatabaseHas('Empleados', ['nombres' => 'Jane', 'telefono' => '444-444-4444']);
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

        $empleado = Empleados::create([
            'cedula' => '123456789',
            'nombres' => 'John',
            'apellidos' => 'Doe',
            'user_id' => $user->id,
        ]);

       // Eliminar el cliente
        $empleado->delete();

       // Verificar que el cliente fue eliminado
        $this->assertDatabaseMissing('Empleados', ['cedula' => '123456789']);
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

        $empleado = Empleados::create([
            'cedula' => '123456789',
            'nombres' => 'John',
            'apellidos' => 'Doe',
            'user_id' => $user->id,
        ]);

        // Verificar que el cliente se puede mostrar
        $foundClient = Empleados::find($empleado->id);
        $this->assertEquals($foundClient->nombres, 'John');
        $this->assertEquals($foundClient->apellidos, 'Doe');
    }
}
