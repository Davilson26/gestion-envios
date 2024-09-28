<?php

namespace Tests\Unit;

use App\Models\Envios;
use App\Models\Clientes;
use App\Models\Empleados;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class EnviosTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_shipping()
    {
        // Crear un cliente de ejemplo
        $cliente = Clientes::create([
            'cedula' => '123456789',
            'nombres' => 'John',
            'apellidos' => 'Doe',
            'telefono' => '555-555-5555',
            'direccion' => '123 Main St',
        ]);

        // Crear un empleado de ejemplo
        $empleado = Empleados::create([
            'cedula' => '987654321',
            'nombres' => 'Jane',
            'apellidos' => 'Doe',
            'telefono' => '666-666-6666',
            'direccion' => '789 Some St',
        ]);

        $envioData = [
            'destinatario' => 'Alice',
            'direccion' => '456 Another St',
            'telefono' => '444-444-4444',
            'peso' => 2.5,
            'costo' => 15.00,
            'cliente_id' => $cliente->id,
            'empleado_id' => $empleado->id,
        ];

        // Crear envio
        $envio = Envios::create($envioData);

        // Verificar que el envio fue creado correctamente
        $this->assertNotNull(Envios::where('destinatario', 'Alice')->first());
    }

    /** @test */
    public function it_can_update_a_shipping()
    {
        // Crear un envio de ejemplo
        $cliente = Clientes::create([
            'cedula' => '123456789',
            'nombres' => 'John',
            'apellidos' => 'Doe',
            'telefono' => '555-555-5555',
            'direccion' => '123 Main St',
        ]);

        $empleado = Empleados::create([
            'cedula' => '987654321',
            'nombres' => 'Jane',
            'apellidos' => 'Doe',
            'telefono' => '666-666-6666',
            'direccion' => '789 Some St',
        ]);

        $envio = Envios::create([
            'destinatario' => 'Alice',
            'direccion' => '456 Another St',
            'telefono' => '444-444-4444',
            'peso' => 2.5,
            'costo' => 15.00,
            'cliente_id' => $cliente->id,
            'empleado_id' => $empleado->id,
        ]);

        // Actualizar los datos del envio
        $updateData = [
            'destinatario' => 'Bob',
            'telefono' => '333-333-3333',
            'costo' => 20.00,
        ];

        $envio->update($updateData);

        // Verificar que los datos fueron actualizados correctamente
        $updatedShipping = Envios::where('destinatario', 'Bob')->first();
        $this->assertNotNull($updatedShipping);
        $this->assertEquals($updatedShipping->telefono, '333-333-3333');
        $this->assertEquals($updatedShipping->costo, 20.00);
    }

    /** @test */
    public function it_can_delete_a_shipping()
    {
        // Crear un envio de ejemplo
        $cliente = Clientes::create([
            'cedula' => '123456789',
            'nombres' => 'John',
            'apellidos' => 'Doe',
            'telefono' => '555-555-5555',
            'direccion' => '123 Main St',
        ]);

        $empleado = Empleados::create([
            'cedula' => '987654321',
            'nombres' => 'Jane',
            'apellidos' => 'Doe',
            'telefono' => '666-666-6666',
            'direccion' => '789 Some St',
        ]);

        $envio = Envios::create([
            'destinatario' => 'Alice',
            'direccion' => '456 Another St',
            'telefono' => '444-444-4444',
            'peso' => 2.5,
            'costo' => 15.00,
            'cliente_id' => $cliente->id,
            'empleado_id' => $empleado->id,
        ]);

        // Eliminar el envio
        $envio->delete();

        // Verificar que el envio fue eliminado
        $this->assertNull(Envios::where('destinatario', 'Alice')->first());
    }

    /** @test */
    public function it_can_show_a_shipping()
    {
        // Crear un envio de ejemplo
        $cliente = Clientes::create([
            'cedula' => '123456789',
            'nombres' => 'John',
            'apellidos' => 'Doe',
            'telefono' => '555-555-5555',
            'direccion' => '123 Main St',
        ]);

        $empleado = Empleados::create([
            'cedula' => '987654321',
            'nombres' => 'Jane',
            'apellidos' => 'Doe',
            'telefono' => '666-666-6666',
            'direccion' => '789 Some St',
        ]);

        $envio = Envios::create([
            'destinatario' => 'Alice',
            'direccion' => '456 Another St',
            'telefono' => '444-444-4444',
            'peso' => 2.5,
            'costo' => 15.00,
            'cliente_id' => $cliente->id,
            'empleado_id' => $empleado->id,
        ]);

        // Verificar que el envio se puede mostrar
        $foundShipping = Envios::find($envio->id);
        $this->assertEquals($foundShipping->destinatario, 'Alice');
        $this->assertEquals($foundShipping->telefono, '444-444-4444');
    }
}
