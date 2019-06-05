<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeUserController extends Controller
{
	//Metodo que sera llamado desde rutas sin pasarle el nombre del metodo ya que solo tendra un unico metodo. El metodo en este caso debe llamarse __invoke
    public function __invoke($name, $nickname = null)
    {
    	if (is_null($nickname)) {
			return "Hola {$name}, no tiene apodo";
		}
		else{
			return "Hola {$name}, su apodo es {$nickname}";
		}
    }
}
