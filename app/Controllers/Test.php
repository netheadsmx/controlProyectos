<?php

namespace App\Controllers;
use App\Libraries\ControlProyectosLib; //Libreria personalizada
use App\Models\UsuariosModel;
use App\Models\ClientesModel;
use App\Models\ClientesUsuariosModel;
use CodeIgniter\I18n\Time;

class Test extends BaseController
{
    public function __construct() 
	{
		helper(['url']);
	}

    public function regex() {
        $password ="G03659143e";
        $regex = '/^\S*(?=\S{12,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/';
        if (preg_match($regex,$password)) {
            echo "MATCH";
        } else {
            echo "NO MATCH";
        }
    }

    public function redirect()
    {
        return redirect()->to('/auth/register/company/');
    }

    public function endsession()
    {
        $session = \Config\Services::session();
        $session->destroy();
    }

    public function startsession()
    {
        $session = \Config\Services::session();
        $session->set('id',21);
    }

    public function testpwd()
    {
        if (ControlProyectosLib::validate_password('Admin1234567890','$2y$12$/WDdsCOzRItb8st9glAeDeCdtW8L6NhxFWjCGSQeB8hRTv8//bmxy'))
        { 
            echo 'TRUE';
        } else {
            echo 'FALSE';
        }
    }

    public function encriptpwd()
    {
        echo ControlProyectosLib::encript_password('Admin1234567890');
    }

    public function update()
    {
        $new = new UsuariosModel();
        $newdata = [
            'nombre_usuario' => 'Gonzalo Jesus'
        ];
        try {
            $new->updateUsuarioxCampo('idUsuarios',27,$newdata);
            echo 'Ok';
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }
}
