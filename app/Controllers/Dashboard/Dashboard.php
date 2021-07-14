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
            $titulo['titulo'] = "LTE | Dashboard";
            $menu['menu'] = "dashboard";
            echo view('templates/header',$titulo);
            echo view('templates/scripts_main');
            echo view('templates/menu',$menu);
            echo view('dashboard/start');
            echo view('templates/footer');
            echo view('templates/footer_script_main');
        }
    }
}