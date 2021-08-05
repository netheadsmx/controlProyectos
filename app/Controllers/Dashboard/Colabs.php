<?php

namespace App\Controllers\Dashboard;
use App\Controllers\BaseController;
use App\Models\ColabsModel;
use App\Models\SolicitudesModel;
use App\Models\EstadosModel;
use App\Models\TipoUsuariosModel;
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
            $model2 = new TipoUsuariosModel();
            $datos['tipousuarios'] = $model2->findAll();
            $titulo['titulo'] = "LTE | Colaboradores";
            $menu['menu'] = "colabs";
            echo view('templates/header',$titulo);
            echo view('templates/scripts_datatables');
            echo view('templates/menu',$menu);
            echo view('dashboard/colaboradores',$datos);
            echo view('templates/footer');
            echo view('templates/footer_colab_datatables');
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
				'rules' => 'required|valid_email|validate_invitacion_correo|validate_invitacion_enviada',
				'errors' => [
					'required' => '{field} es requerido.',
                    'valid_email' => 'Correo no valido, favor de verificar.',
                    'validate_invitacion_correo' => 'Este correo ya esta registrado, favor de verificar.',
                    'validate_invitacion_enviada' => 'Ya has enviado una invitacion a este correo, favor de verificar.'
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
            $insert = [
                'nombre_sol' => htmlspecialchars($_POST['nombre']),
                'apellido_sol' => htmlspecialchars($_POST['apellido']),
                'correo_sol' => htmlspecialchars($_POST['correo']),
                'fecha_sol' => ControlProyectosLib::get_fecha_hora_today(),
                'iniciado_por' => $_SESSION['idUsr'],
                'Empresa_sol' => $_SESSION['cmpnId'],
                'tipo' => 'I'
            ];
            $model = new SolicitudesModel();
            try {
                $model->insert($insert);
                $data = [
                    'result' => true
                ];
                echo json_encode($data);
            } catch (\Exception $e) {
                die($e->getMessage());
                //throw new \CodeIgniter\Database\Exceptions\DatabaseException();
            }
        } 
    }

    public function aceptarSolicitudes()
    {
        $solicitudes = $_POST['solicitudes'];
        $model = new SolicitudesModel();
        foreach ($solicitudes as $s) {
            $solicitud = $model->checkSolicitudValida($s,$_SESSION['cmpnId']);
            if ($solicitud) {
                $colab = [
                    'nombre_colab' => $solicitud[0]['nombre_sol'],
                    'apellido_colab' => $solicitud[0]['apellido_sol'],
                    'EmpresaId' => $_SESSION['cmpnId'],
                    'correo_colab' => $solicitud[0]['correo_sol'],
                    'Estados_idEstados' => 1,
                    'activado' => 1,
                    'ultimo_cambio' => ControlProyectosLib::get_fecha_hora_today(),
                    'TipoUsuarios_idTipoUsuarios' => (int)htmlspecialchars($_POST['colab'])
                ];
                $insertar = new ColabsModel();
                if ($insertar->insert($colab)) {
                    $data = [
                        'error' => false,
                    ];
                    $model->eliminarSolicitud($s);
                } else {
                    $data = [
                        'error' => true,
                        'descripcion' => 'La solicitud aprobada no es valida. Solo se deben de aceptar solicitudes y no invitaciones'
                    ];
                } 
            } else {
                $data = [
                    'error' => true,
                    'descripcion' => 'La solicitud aprobada no es valida. Solo se deben de aceptar solicitudes y no invitaciones'
                ]; 
            } 
        } 
        echo json_encode($data);
    }

    public function eliminarSolicitudes() {
        $solicitudes = $_POST['eliminar'];
        $model = new SolicitudesModel();
        foreach ($solicitudes as $s) {
            if ($model->eliminarSolicitud($s)) {
                $data = [
                    'error' => false,
                ];
                //SE NECESITA NOTIFICAR AL USUARIO QUE SE RECHAZO SU SOICITUD DE UNIRSE Y SE
                //DEBE DE DAR OPCIÓN DE VOLVER A ENVIAR UNA SOLICITUD, O DE ABANDONAR LA PLATAFORMA
                //SI SE ABANDONA LA PLATAFORMA SE DEBERA DE ELIMINAR LA CUENTA DE LA TABLA USUARIOS
            } else {
                $data = [
                    'error' => true,
                    'descripcion' => 'Ha ocurrido un error al eliminar la solicitud, favor de intentar m&aacute;s tarde.'
                ]; 
            }
        }
        echo json_encode($data);
    }
}