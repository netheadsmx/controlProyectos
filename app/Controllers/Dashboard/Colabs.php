<?php

namespace App\Controllers\Dashboard;
use App\Controllers\BaseController;
use App\Models\ColabsModel;
use App\Libraries\ControlProyectosLib; //Libreria personalizada

class Colabs extends BaseController
{
    public function __construct() 
	{
		helper(['url']);
        $session = \Config\Services::session();
	}

    public function index()
    {
		if (!isset($_SESSION['email'])) {
			return redirect()->to('/auth/login/');
		} else {
            $titulo['titulo'] = "LTE | Colaboradores";
            $menu['menu'] = "colabs";
            echo view('templates/header',$titulo);
            echo view('templates/scripts_datatables');
            echo view('templates/menu',$menu);
            echo view('dashboard/colaboradores');
            echo view('templates/footer');
            echo view('templates/footer_script_datatables');
        }
    }

    public function getColabs()
    {
        if (!isset($_SESSION['email'])) {
			return redirect()->to('/auth/login/');
		}
        $model = new ColabsModel();
        $colabs = $model->getColabInfo();
        echo json_encode($colabs);
    }
}