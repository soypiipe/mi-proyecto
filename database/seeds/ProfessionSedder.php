<?php

use App\Models\Professions as profesion; //agregando alias
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //Debe escribirse esta linea para poder usar configuracion de la base de datos

class ProfessionSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	//consulta usando sql
    	// DB::insert('INSERT INTO profession (title) VALUES (:title)', 
    	// [
    	// 	'title' => 'Back-end developer'

    	// ]);

    	// DB::table('profession')->insert([
     //    	'title' => 'Back-end developer'
     //    ]);

    	// Usando eluquen al insertar, se completan los campos de create_at y update_at

    	profesion::create([
        	'title' => 'Back-end developer'
        ]);

        profesion::create([
        	'title' => 'Front-end developer'
        ]);

        profesion::create([
        	'title' => 'Web developer'
        ]);
    }
}
