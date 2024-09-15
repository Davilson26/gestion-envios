<?php

namespace Tests\Unit;

// use Tests\TestCase;
use App\Models\Roles;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as TestingTestCase;

class RolesTest extends TestingTestCase
{
    use RefreshDatabase;
    #[\PHPUnit\Framework\Attributes\Test]

    /** @test */
    public function it_can_create_roles()
    {
        // Crear roles y verificar que fueron creados exitosamente
        $roleAdmin = Roles::create(['nombre' => 'Administradores']);
        $roleUser = Roles::create(['nombre' => 'Usuarios']);
        $roleClient = Roles::create(['nombre' => 'Clientes']);

        // Verificar que los roles existen en la base de datos
        $this->assertDatabaseHas('roles', ['nombre' => 'Administradores']);
        $this->assertDatabaseHas('roles', ['nombre' => 'Usuarios']);
        $this->assertDatabaseHas('roles', ['nombre' => 'Clientes']);
        
        // Verificar que los roles fueron creados correctamente
        $this->assertEquals('Administradores', $roleAdmin->nombre);
        $this->assertEquals('Usuarios', $roleUser->nombre);
        $this->assertEquals('Clientes', $roleClient->nombre);
    }

    /** @test */
    public function it_validates_role_creation()
    {
        // Intentar crear un rol sin nombre y verificar que falla
        $this->expectException(\Illuminate\Database\QueryException::class);
        Roles::create(['nombre' => null]);

        // Intentar crear un rol duplicado y verificar que falla
        Roles::create(['nombre' => 'Duplicado']);
        $this->expectException(\Illuminate\Database\QueryException::class);
        Roles::create(['nombre' => 'Duplicado']);
    }
    
}
