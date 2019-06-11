<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use App\Models\Users;

class UserModuleTest extends TestCase
{

    use RefreshDatabase; //Antes de ejecutar la prueba, ejecuta e comando de refrescar la base de datos
    /**
     * @test
     */
    function test_comprueba_url_user_list()
    {
        
        factory(Users::class)->create([
            'name' => 'Diego Amado',
        ]);

        //Compruba que exista la URL 
       $this->get('/usuarios')
       -> assertStatus(200)
       -> assertSee('Listado de usuarios')
       -> assertSee('Diego Amado');
    }

    /**
     * @test
     */
    function test_comprueba_users_empty()
    {
        // DB::table('users')->truncate(); YA NO ES NECESARIO PORQUE SE ESTA USANDO REFRESHDATABASE

        //Compruba que exista la URL 
       $this->get('/usuarios')
       -> assertStatus(200)
       -> assertSee('No hay usuarios registrados');
    }

    /**
     * @test
     */
    function test_comprueba_usuario_detalle()
    {
        $this->get('/usuarios/5')
         -> assertStatus(200)
         -> assertSee("Mostrando detalle del usuario: 5");
    }

    /**
     * @test
     */
    function test_comprueba_usuario_nuevo()
    {
        $this->get('/usuarios/nuevo')
         -> assertStatus(200)
         -> assertSee("Crear un usuario");
    }
}
