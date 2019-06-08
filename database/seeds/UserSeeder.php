<?php

use App\Models\Users;
use App\Models\Professions as profesion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//$profession = DB::select('SELECT id FROM profession WHERE title = ?',['Back-end developer']);

    	$professionId =profesion::select('id','title')
    	->where('title', '=', 'Back-end developer')
    	->value('id'); //se pasa el nombre de la columna que se quiere elegir

        Users::create([
        	'name' => 'Diego Amado',
        	'email' => 'diego_amado_@outlook.com',
        	'password' => bcrypt('123456789'),
        	'profession_id' => $professionId
        ]);


    }
}
