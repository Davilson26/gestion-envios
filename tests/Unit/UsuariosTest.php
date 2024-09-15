<?php

namespace Tests\Unit;

use App\Models\Roles;
// use Tests\TestCase;
use App\Models\Usuarios;
use Illuminate\Foundation\Testing\TestCase as TestingTestCase;
// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class UsuariosTest extends TestingTestCase
{
    #[\PHPUnit\Framework\Attributes\Test]

    // use RefreshDatabase;
    public function test_routes(): void
    {
        $get = $this->get('/');
        $get->assertStatus(200);
    }
    /** @test */
    protected function create_roles(): void
    {
        Roles::create(['nombre' => 'Administradores'])->assertStatus(200);
        Roles::create(['nombre' => 'Usuarios'])->assertStatus(200);
        Roles::create(['nombre' => 'Clientes'])->assertStatus(200);

    }
    public function it_can_create_a_user()
    {
        // Crear un usuario de ejemplo
        $user = Usuarios::create([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => Hash::make('password123'),
            'rol_id' => 1,
        ]);

        $user->assertStatus(200);
        
        // Verificar que el usuario fue creado
        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'rol_id' => 1
        ]);

        // Verificar que la contraseña está oculta
        $this->assertNotEquals('password123', $user->password);

        // Verificar que el ID de rol es correcto
        $this->assertEquals(1, $user->rol_id);
    }

    // /** @test */
    // public function it_has_hidden_attributes()
    // {
    //     $user = new Usuarios([
    //         'name' => 'John Doe',
    //         'email' => 'johndoe@example.com',
    //         'password' => 'password123',
    //         'rol_id' => 1,
    //     ]);

    //     // Verificar que los atributos ocultos están configurados correctamente
    //     $this->assertArrayHasKey('password', $user->getHidden());
    //     $this->assertArrayHasKey('remember_token', $user->getHidden());
    // }

    // /** @test */
    // public function it_casts_attributes()
    // {
    //     $user = new Usuarios([
    //         'email_verified_at' => '2024-09-11 00:00:00',
    //         'password' => hash::make('password123'),
    //     ]);

    //     // Verificar que los atributos son casteados correctamente
    //     $this->assertInstanceOf(\DateTime::class, $user->email_verified_at);
    //     $this->assertNotEquals('password123', $user->password);
    // }
}
