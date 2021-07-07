<?php

namespace App\Controllers\Dashboard;
use App\Controllers\BaseController;
use App\Libraries\ControlProyectosLib; //Libreria personalizada

class Dashboard extends BaseController
{
    public function __construct() 
	{
		helper(['url']);
        $session = \Config\Services::session();
	}

    public function index()
    {
        $session = \Config\Services::session();
		if (!isset($_SESSION['email'])) {
			return redirect()->to('/auth/login/');
		} else {
            echo 'TODO OK';
        }
    }
}