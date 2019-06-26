<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use App\Models\Users;


class UserModuleTest extends TestCase
{
    use RefreshDatabase; //Trade que Antes de ejecutar la prueba, ejecuta e comando de refrescar la base de datos
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
        $user = factory(Users::class)->create([
            'name' => 'Diego Amado'
        ]);
        
        $this->get("/usuarios/{$user->id}")
         -> assertStatus(200)
         -> assertSee("Diego Amado");
    }
    
    /**
     * @test
     */
    function test_muestra_404_si_no_encuentra_usuario()
    {
       $this->get("usuarios/999")
               ->assertStatus(404)
               ->assertSee("Pagina no encontrada");
    }

    /**
     * @test
     */
    function test_comprueba_usuario_nuevo()
    {
        $this->get('/usuarios/nuevo')
         -> assertStatus(200)
         -> assertSee("Crear neuvo usuario");
    }
    
     /**
     * @test
     */
    function test_crear_usuario_nuevo()
    {
        $this->post('/usuarios/', [
           'name' => 'Diego Amado',
           'email' => 'diego_amado_@outlook.com',
           'password' => '123456'
        ])->assertRedirect(route('users'));
        
        $this->assertCredentials([
           'name' => 'Diego Amado',
           'email' => 'diego_amado_@outlook.com',
           'password' => '123456'
        ]);
    }
    
    function test_usuario_obligatorio()
    {
        $this->from('usuarios/nuevo')
           ->post('/usuarios/', [
           'name' => '',
           'email' => 'diego_amado_@outlook.com',
           'password' => '123456'
        ])->assertRedirect('usuarios/nuevo')
          ->assertSessionHasErrors(['name' => 'El campo nombre es obligatorio']);
        
        $this->assertDatabaseMissing('users', 
        [
            'email' => 'diego_amado_@outlook.com',
        ]);
    }
    
    function test_email_obligatorio()
    {
        $this->from('usuarios/nuevo')
           ->post('/usuarios/', [
           'name' => 'Deigo Amado',
           'email' => '',
           'password' => '123456'
        ])->assertRedirect('usuarios/nuevo')
          ->assertSessionHasErrors(['email' => 'El campo email es obligatorio']);
        
        $this->assertDatabaseMissing('users', 
        [
            'name' => 'Diego Amado',
        ]);
    }
    
    function test_email_no_valido()
    {
        $this->from('usuarios/nuevo')
           ->post('/usuarios/', [
           'name' => 'Deigo Amado',
           'email' => 'correo-no-valido',
           'password' => '123456'
        ])->assertRedirect('usuarios/nuevo')
          ->assertSessionHasErrors(['email' => 'Email invalido']);
        
        $this->assertDatabaseMissing('users', 
        [
            'name' => 'Diego Amado',
        ]);
    }
    
    function test_email_unico()
    {
        factory(Users::class)->create([
            'email' => 'diego_amado_@outlook.com'
        ]);
        
        $this->from('usuarios/nuevo')
           ->post('/usuarios/', [
           'name' => 'Deigo Amado',
           'email' => 'diego_amado_@outlook.com',
           'password' => '123456'
        ])->assertRedirect('usuarios/nuevo')
          ->assertSessionHasErrors(['email' => 'Email duplicado']);
        
        $this->assertDatabaseMissing('users', 
        [
            'name' => 'Diego Amado',
        ]);
    }
    
    function test_password_obligatorio()
    {
        $this->from('usuarios/nuevo')
           ->post('/usuarios/', [
           'name' => 'Diego Amado',
           'email' => 'diego_amado_@outlook.com',
           'password' => ''
        ])->assertRedirect('usuarios/nuevo')
          ->assertSessionHasErrors(['password']);
        
        $this->assertDatabaseMissing('users', 
        [
            'name' => 'Diego Amado',
            'email' => 'diego_amado_@outlook.com'
        ]);
    }
     
    /**
     * @test
     */
    function test_comprueba_editar_usuario()
    {
        $user = factory(Users::class)->create();
        
        $this->get("/usuarios/{$user->id}/editar")
         -> assertStatus(200)
         ->assertViewIs('users.edit')
         -> assertSee("Editar usuario")
        ->assertViewHas('user', function ($viewUser) use ($user){
            return $viewUser->id === $user->id;
        });
    }
    
    /**
     * @test
     */
    function test_editar_usuario()
    {
        $user = factory(Users::class)->create();
        
        $this->withExceptionHandling();
        
        $this->put("/usuarios/{$user->id}", [
           'name' => 'Diego Amado',
           'email' => 'diego_amado_@outlook.com',
           'password' => '1234561'
        ])->assertRedirect("/usuarios/{$user->id}");
        
        $this->assertCredentials([
           'name' => 'Diego Amado',
           'email' => 'diego_amado_@outlook.com',
           'password' => '1234561'
        ]);
    }
    
    function test_usuario_obligatorio_al_actualizar()
    {
        $user = factory(Users::class)->create();
        
        $this->from("/usuarios/{$user->id}/editar")
            ->put("/usuarios/{$user->id}", [
           'name' => '',
           'email' => 'diego_amado_@outlook.com',
           'password' => '123456'
        ])->assertRedirect("/usuarios/{$user->id}/editar")
          ->assertSessionHasErrors(['name' => 'El campo nombre es obligatorio']);
        
        $this->assertDatabaseMissing('users', 
        [
            'email' => 'diego_amado_@outlook.com',
        ]);
    }
    
    function test_email_obligatorio_al_actualizar()
    {
        $user = factory(Users::class)->create();
        
         $this->from("/usuarios/{$user->id}/editar")
            ->put("/usuarios/{$user->id}", [
           'name' => 'Diego Amado',
           'email' => '',
           'password' => '123456'
        ])->assertRedirect("/usuarios/{$user->id}/editar")
          ->assertSessionHasErrors(['email' => 'El campo email es obligatorio']);
        
        $this->assertDatabaseMissing('users', 
        [
            'name' => 'Diego Amado',
        ]);
    }
    
    function test_email_no_valido_al_actualizar()
    {
        $user = factory(Users::class)->create();
        
         $this->from("/usuarios/{$user->id}/editar")
            ->put("/usuarios/{$user->id}", [
           'name' => 'Diego Amado',
           'email' => 'email-no-valido',
           'password' => '123456'
        ])->assertRedirect("/usuarios/{$user->id}/editar")
          ->assertSessionHasErrors(['email' => 'Email invalido']);
        
        $this->assertDatabaseMissing('users', 
        [
            'name' => 'Diego Amado',
        ]);
    }
    
    function test_email_unico_al_actualizar()
    {
        //$this->withoutExceptionHandling();
        
        factory(Users::class)->create([
            'email' => 'email-existente@example.com'
        ]);
        
        $user = factory(Users::class)->create([
            'email' => 'diego_amado_@outlook.com'
        ]);
        
        $this->from("/usuarios/{$user->id}/editar")
            ->put("/usuarios/{$user->id}", [
           'name' => 'Diego Amado',
           'email' => 'email-existente@example.com',
           'password' => '123456'
        ])->assertRedirect("/usuarios/{$user->id}/editar")
          ->assertSessionHasErrors(['email']);
        
        $this->assertDatabaseMissing('users', 
        [
            'name' => 'Diego Amado',
        ]);
    }
    
    function test_password_opcional_al_actualizar()
    {
        $oldpassword = 'clave-anterior';
        $user = factory(Users::class)->create([
            'password' => bcrypt($oldpassword)
        ]);
        
               
        $this->from("usuarios/{$user->id}/editar")
            ->put("usuarios/{$user->id}", [
           'name' => 'Diego Amado',
           'email' => 'diego_amado_@outlook.com',
           'password' => ''
        ])->assertRedirect("usuarios/{$user->id}"); //(users.show)
        
        $this->assertCredentials(
        [
            'name' => 'Diego Amado',
            'email' => 'diego_amado_@outlook.com',
            'password' =>  $oldpassword
        ]);
    }
    
    function test_email_igual_al_actualizar()
    {
        $user = factory(Users::class)->create([
            'email' => 'diego_amado_@outlook.com',
        ]);
        
               
        $this->from("usuarios/{$user->id}/editar")
            ->put("usuarios/{$user->id}", [
           'name' => 'Diego Amado',
           'email' => 'diego_amado_@outlook.com',
           'password' => '1234556'
        ])->assertRedirect("usuarios/{$user->id}"); //(users.show)
        
        $this->assertDatabaseHas('users',
        [
            'name' => 'Diego Amado',
            'email' => 'diego_amado_@outlook.com',
   
        ]);
    }
    
    function test_eliminar_usuario(){
        
        $this->withoutExceptionHandling();
        $user = factory(Users::class)->create();
        
        $this->delete("usuarios/$user->id")
                ->assertRedirect('usuarios');
        
        $this->assertDatabaseMissing('users', [
            'id' => $user->id 
        ]);
    }
}
