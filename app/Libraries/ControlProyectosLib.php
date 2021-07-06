<?php 
/*
    Libreria con funciones personalizadas que se ocuparan en todo el sistema
*/


namespace App\Libraries;
use CodeIgniter\I18n\Time;

class ControlProyectosLib
{
    public static function encript_password($password)
	{
		$opciones = [
			'cost' => 12,
		];
		return password_hash($password,PASSWORD_BCRYPT,$opciones);
	}

    public static function get_fecha_hora_today()
    {
        $hoy = new Time('now','America/Mexico_City','en_US');
        return $hoy->toLocalizedString('yyyy-MM-dd h:m');
    }

    public static function get_fecha_mas_mes()
    {
        $hoy = new Time('now','America/Mexico_City','en_US');
        $next = $hoy->addMonths(1);
        return $next->toLocalizedString('yyyy-MM-dd h:m');
    }
}