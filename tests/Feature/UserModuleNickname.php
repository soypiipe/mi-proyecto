<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserModuleNickname extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @test
     */
    function test_whit_nickname()
    {
        $this->get('/saludo/Diego/Pipe')
        ->assertStatus(200)
        ->assertSee('Hola Diego, su apodo es Pipe');
    }

    /**
     * A basic feature test example.
     *
     * @test
     */
    function test_whitout_nickname()
    {
        $this->get('/saludo/Diego')
        -> assertStatus(200)
        -> assertSee('Hola Diego, no tiene apodo');
    }
}

