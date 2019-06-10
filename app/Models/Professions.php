<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professions extends Model
{
    protected $fillable = ['title'];

    //Trae todos los usuarios que pertenecen a una profesion
    public function users()
    {
    	return $this->hasMany(Users::class); //hasMany indica que puede existir varios usuarios para una profesion y devuelve una coleccion
    }
}
