<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Professions;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

    	$this->truncateTable([
    		'professions',
    		'users'
    	]);
    	

        $this->call(ProfessionSedder::class);
        $this->call(UserSeeder::class);


    }

    protected function truncateTable(array $tables)
    {
    	DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); //Quita validacion de llave foranea

    	foreach ($tables as $table) {
            DB::table($table)->truncate(); //Vacia la tabla
    	}

    	DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
