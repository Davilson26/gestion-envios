<?php

namespace Tests\Unit;

use App\Models\Envios;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as TestingTestCase;

class EnviosTest extends TestingTestCase
{
    use RefreshDatabase;

    #[\PHPUnit\Framework\Attributes\Test]
    /** @test */
    public function it_can_create_a_shipping()
    {
        // Crear un usuario para el envío
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => bcrypt('password123'), // Usar bcrypt directamente
            'rol_id' => 3,
        ]);

        $envioData = [
            'origen' => 'Ciudad A',
            'destino' => 'Ciudad B',
            'descripcion' => 'Descripción del envío',
            'codigo_envio' => 'C123',
            'estado' => 1,
            'empleados_idempleados' => 1, 
            'clientes_idremitente' => 1,   
            'clientes_iddestinatario' => 2, 
        ];

        // Crear el envío
        $envio = Envios::create($envioData);

        // Verificar que el envío fue creado correctamente
        $this->assertDatabaseHas('envios', ['codigo_envio' => 'C123']);
    }

    public function it_can_update_a_shipping()
    {
        // Crear un envío de ejemplo
        $envio = Envios::create([
            'origen' => 'Ciudad A',
            'destino' => 'Ciudad B',
            'descripcion' => 'Descripción inicial',
            'codigo_envio' => 'C123',
            'estado' => 1,
            'empleados_idempleados' => 1,
            'clientes_idremitente' => 1,
            'clientes_iddestinatario' => 2,
        ]);

        // Actualizar los datos del envío
        $updateData = [
            'descripcion' => 'Descripción actualizada',
            'estado' => 'enviado',
        ];

        $envio->update($updateData);

        // Verificar que los datos fueron actualizados correctamente
        $this->assertDatabaseHas('envios', ['descripcion' => 'Descripción actualizada', 'estado' => 'enviado']);
    }

    public function it_can_delete_a_shipping()
    {
        // Crear un envío de ejemplo
        $envio = Envios::create([
            'origen' => 'Ciudad A',
            'destino' => 'Ciudad B',
            'descripcion' => 'Descripción inicial',
            'codigo_envio' => 'C123',
            'estado' => 1,
            'empleados_idempleados' => 1,
            'clientes_idremitente' => 1,
            'clientes_iddestinatario' => 2,
        ]);

        // Eliminar el envío
        $envio->delete();

        // Verificar que el envío fue eliminado
        $this->assertDatabaseMissing('envios', ['codigo_envio' => 'C123']);
    }

    public function it_can_show_a_shipping()
    {
        // Crear un envío de ejemplo
        $envio = Envios::create([
            'origen' => 'Ciudad A',
            'destino' => 'Ciudad B',
            'descripcion' => 'Descripción inicial',
            'codigo_envio' => 'C123',
            'estado' => 1,
            'empleados_idempleados' => 1,
            'clientes_idremitente' => 1,
            'clientes_iddestinatario' => 2,
        ]);

        // Verificar que el envío se puede mostrar
        $foundEnvio = Envios::find($envio->id);
        $this->assertEquals($foundEnvio->codigo_envio, 'C123');
    }
}
