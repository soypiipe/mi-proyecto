<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserModuleTest extends TestCase
{
    /**
     * @test
     */
    function test_comprueba_url_usuarios()
    {
        //Compruba que exista la URL 
       $this->get('/usuarios')
       -> assertStatus(200)
       -> assertSee('Listado de usuarios')
       -> assertSee('Diego')
       -> assertSee('Laura');
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
