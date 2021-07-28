<?php

namespace App\Controllers\Dashboard;
use App\Controllers\BaseController;
use App\Models\ColabsModel;
use App\Models\SolicitudesModel;
use App\Models\EstadosModel;
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
            $model = new EstadosModel();
            $datos['estados'] = $model->findAll();
            $titulo['titulo'] = "LTE | Colaboradores";
            $menu['menu'] = "colabs";
            echo view('templates/header',$titulo);
            echo view('templates/scripts_datatables');
            echo view('templates/menu',$menu);
            echo view('dashboard/colaboradores',$datos);
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

    public function getSolicitudes()
    {
        if (!isset($_SESSION['email'])) {
			return redirect()->to('/auth/login/');
		}
        $model = new SolicitudesModel();
        $colabs = $model->getSolicitudes('Empresa_sol',$_SESSION['cmpnId'],'*');
        echo json_encode($colabs);
    }

    public function getColabxId(){
        $model = new ColabsModel();
        $colab = $model->getColabxId(htmlspecialchars($_POST['colabId']));
        echo json_encode($colab);
    }

    public function updateColabxId() {
        $id = htmlspecialchars($_POST['colabId']);
        $estado = htmlspecialchars($_POST['estadoId']);
        $model = new ColabsModel();
        $data = [
            'Estados_idEstados' => $estado,
            'ultimo_cambio' => ControlProyectosLib::get_fecha_hora_today()
        ];
        $colab = $model->updateColabxId($id,$data);
        echo json_encode($colab);
    }

    public function validarDatosInvitacion() {
        $validations = $this->validate([
			'nombre' => [
				'label' => 'Nombre',
				'rules' => 'required|alpha_space',
				'errors' => [
					'required' => '{field} es requerido.',
                    'alpha_space' => 'El nombre solo permite letras.'
				]
			],
            'apellido' => [
				'label' => 'Apellido',
				'rules' => 'required|alpha_space',
				'errors' => [
					'required' => '{field} es requerido.',
                    'alpha_space' => 'El apellido solo permite letras.'
				]
			],
            'correo' => [
				'label' => 'Correo electronico',
				'rules' => 'required|valid_email',
				'errors' => [
					'required' => '{field} es requerido.',
                    'valid_email' => 'Correo no valido, favor de verificar.',
                    'validate_invitacion_correo' => 'Este correo ya esta registrado, favor de verificar.'
				]
			]
        ]);
        if(!$validations)
		{
            $validation = \Config\Services::validation();
            $data = [
                'result' => false,
                'errors' => $validation->getErrors()
            ];
            echo json_encode($data);
        } else {
            echo json_encode ("TODO BIEN");
        } 
    }
}