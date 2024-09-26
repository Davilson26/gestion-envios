<?php
namespace Tests\Unit;

use App\Models\Envios;
use App\Models\Empleados;
use App\Models\Clientes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as TestingTestCase;

class EnviosTest extends TestingTestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_envios()
    {
        // Crear empleados y clientes necesarios para el envío
        $empleado = Empleados::create([
            'cedula' => '123456789',
            'nombres' => 'Jane',
            'apellidos' => 'Doe',
            'cargo' => 'empleado',
            'user_id' => 5, // Ajusta según tus datos de usuario
        ]);

        $clienteRemitente = Clientes::create([
            'nombre' => 'John',
            'apellido' => 'Doe',
            'email' => 'johndoe@example.com',
            'telefono' => '123456789',
        ]);

        $clienteDestinatario = Clientes::create([
            'nombre' => 'Alice',
            'apellido' => 'Smith',
            'email' => 'alicesmith@example.com',
            'telefono' => '987654321',
        ]);

        // Crear envíos y verificar que fueron creados exitosamente
        $envio1 = Envios::create([
            'origen' => 'Oficina Central',
            'destino' => 'Sucursal Norte',
            'descripcion' => 'Paquete de documentos importantes.',
            'codigo_envio' => 'ENV-001',
            'estado' => 1,
            'empleados_idempleados' => $empleado->id,
            'clientes_idremitente' => $clienteRemitente->id,
            'clientes_iddestinatario' => $clienteDestinatario->id,
        ]);

        // Verificar que los envíos existen en la base de datos
        $this->assertDatabaseHas('envios', ['codigo_envio' => 'ENV-001']);
        $this->assertDatabaseHas('envios', ['descripcion' => 'Paquete de documentos importantes.']);
        
        // Verificar que los envíos fueron creados correctamente
        $this->assertEquals('Oficina Central', $envio1->origen);
        $this->assertEquals('Sucursal Norte', $envio1->destino);
    }

    /** @test */
    public function it_validates_envio_creation()
    {
        // Intentar crear un envío sin origen y verificar que falla
        $this->expectException(\Illuminate\Database\QueryException::class);
        Envios::create([
            'origen' => null,
            'destino' => 'Sucursal Norte',
            'descripcion' => 'Paquete de documentos.',
            'codigo_envio' => 'ENV-002',
            'estado' => 1,
            'empleados_idempleados' => 1, // Ajusta según tus datos
            'clientes_idremitente' => 1,   // Asegúrate de que estos IDs existan
            'clientes_iddestinatario' => 2,
        ]);

        // Intentar crear un envío duplicado y verificar que falla
        Envios::create([
            'origen' => 'Oficina Central',
            'destino' => 'Sucursal Norte',
            'descripcion' => 'Paquete de documentos.',
            'codigo_envio' => 'ENV-003',
            'estado' => 1,
            'empleados_idempleados' => 1,
            'clientes_idremitente' => 1,
            'clientes_iddestinatario' => 2,
        ]);

        $this->expectException(\Illuminate\Database\QueryException::class);
        Envios::create([
            'origen' => 'Oficina Central',
            'destino' => 'Sucursal Norte',
            'descripcion' => 'Paquete de documentos.',
            'codigo_envio' => 'ENV-003', // Duplicado
            'estado' => 1,
            'empleados_idempleados' => 1,
            'clientes_idremitente' => 1,
            'clientes_iddestinatario' => 2,
        ]);
    }
}
