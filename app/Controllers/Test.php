<?php

namespace App\Controllers;
use App\Libraries\ControlProyectosLib; //Libreria personalizada
use App\Models\UsuariosModel;
use App\Models\ClientesModel;
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

    public function gclientes()
    {
        $clientes = new ClientesModel();
        var_dump($clientes->getClientexCampo('corto_cliente','netheads','*'));
    }
}
