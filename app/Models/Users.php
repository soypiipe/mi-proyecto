<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
	protected $fillable = ['name', 'email', 'password'];

    public function isAdmin()
    {
    	return $this->email === 'diego_amado_@outlook.com';
    }

    public function addUser()
    {
    	$this->create(['name' => 'Natalia Arias', 'email' => 'yinata3@hotmail.com', 'password' => bcrypt('123')]);
    }

    public static function findByEmail($email)
    {
    	return static::where(compact('email'))->first();
    }


    //Metodo que permite traer la profesion de un usuario
    public function profession()
    {
    	return $this->belongsTo(Professions::class); //belongsTo indica que una profesion le pertenece a un usuario y devuelve profesion
    }
}
