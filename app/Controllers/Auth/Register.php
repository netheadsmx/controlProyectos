<?php

namespace App\Controllers\Auth;
use App\Controllers\BaseController;
use App\Models\PaisesModel;
use App\Models\UsuariosModel;
use App\Models\ClientesModel;
use App\Models\ClientesUsuariosModel;
use App\Models\ColabsModel;
use App\Models\SolicitudesModel;
use App\Libraries\ControlProyectosLib; //Libreria personalizada

class Register extends BaseController
{

	public function __construct() 
	{
		helper(['url']);
	}

	public function index()
	{
		$paises = new PaisesModel();
		$data['paises'] = $paises->findAll();
		$header['titulo'] = "LTE | Crea una cuenta ahora";
		echo view('auth/headerAuth',$header);
		echo view('auth/register',$data);
		echo view('auth/footerAuth');
	}

	public function check_user_data()
	{
		$validations = $this->validate([
			'nombre' => [
				'label' => 'Nombre',
				'rules' => 'required|alpha_space',
				'errors' => [
					'required' => '{field} es requerido'
				]
			],
			'apellidos' => [
				'label' => 'Apellido',
				'rules' => 'required|alpha_space',
				'errors' => [
					'required' => '{field} es requerido'
				]
			],
			'email' => [
				'label' => 'correo electronico',
				'rules' => 'required|valid_email|is_unique[Usuarios.correo_usuario]',
				'errors' => [
					'required' => 'El {field} es requerido',
					'valid_email' => 'El {field} no es valido',
					'is_unique' => 'El {field} ya existe.'
				]
			],
			'pais' => [
				'label' => 'pais',
				'rules' => 'required|not_in_list[0]',
				'errors' => [
					'required' => 'El {field} es requerido.',
					'not_in_list' => 'El {field} es obligatorio.'
				]
			],
			'password' => [
				'label' => 'Password',
				'rules' => 'required|min_length[12]|max_length[30]|validate_password',
				'errors' => [
					'required' => '{field} es requerido',
					'min_length' => 'El {field} debe tener al menos 12 caracteres',
					'max_length' => 'El {field} puede tener hasta 30 caracteres',
					'validate_password' => 'El {field} debe tener al menos una letra mayuscula, una minuscula, y un numero.'
				]
			],
			'confirm' => [
				'label' => 'Passwords',
				'rules' => 'required|matches[password]',
				'errors' => [
					'required' => '{field} es requerido',
					'matches' => 'Los passwords no coinciden'
				]
			],
			'terminos' => [
				'label' => 'Terminos y condiciones',
				'rules' => 'in_list[agree]',
				'errors' => [
					'in_list' => 'Es necesario aceptar los {field}'
				]
			],
		]);
		if(!$validations)
		{
			$header['titulo'] = "LTE | Crea una cuenta ahora";
			$paises = new PaisesModel();
			$data = $paises->findAll();
			echo view('auth/headerAuth',$header);
			echo view('auth/register', [
                'validation' => $this->validator,
				'nombre' => htmlspecialchars($_POST['nombre']),
				'apellidos' => htmlspecialchars($_POST['apellidos']),
				'email' => htmlspecialchars($_POST['email']),
				'paises' => $data
            ]);
			echo view('auth/footerAuth');
		} else {
			$usuarios = new UsuariosModel();
			$data = [
				'nombre_usuario' => htmlspecialchars($_POST['nombre']),
				'apellido_usuario' => htmlspecialchars($_POST['apellidos']),
				'correo_usuario' => htmlspecialchars($_POST['email']),
				'password_usuario' => ControlProyectosLib::encript_password($_POST['password']),
				'valido_usuario' => 0,
				'ultima_conexion' => ControlProyectosLib::get_fecha_hora_today(),
				'Paises_idPaises' => htmlspecialchars($_POST['pais'])
			];
			try {
				$usuarios->insert($data);
				$id = $usuarios->insertID();
				$session = \Config\Services::session();
				$session->set('id',$id);
				return redirect()->to('/auth/register/company/');
			} catch (\Exception $e) {
				throw new \CodeIgniter\Database\Exceptions\DatabaseException();
			}
		}
	}

	public function company()
	{
		$session = \Config\Services::session();
		if (!isset($_SESSION['id'])) {
			return redirect()->to('/auth/register/');
		}
		$header['titulo'] = "LTE | Empresa o Compa&ntilde;ia";
		echo view('auth/headerAuth',$header);
		echo view('auth/company');
		echo view('auth/footerAuth');
	}
	
	public function new()
	{
		$session = \Config\Services::session();
		if (!isset($_SESSION['id'])) {
			return redirect()->to('/auth/register/');
		}
		$paises = new PaisesModel();
		$data['paises'] = $paises->findAll();
		$header['titulo'] = "LTE | Crear nueva Compa&ntilde;ia";
		echo view('auth/headerAuth',$header);
		echo view('auth/new',$data);
		echo view('auth/footerAuth');
	}

	public function check_new_company()
	{
		$validations = $this->validate([
			'nombre_corto' => [
				'label' => 'Nombre corto',
				'rules' => 'required|alpha_numeric|is_unique[Clientes.corto_cliente]',
				'errors' => [
					'required' => '{field} es requerido',
					'alpha_numeric' => '{field} solo puede tener numeros y letras.',
					'is_unique' => 'Este nombre ya esta siendo utilizado, facor de seleccionar otro.'
				]
			],
			'legal' => [
				'label' => 'Nombre legal',
				'rules' => 'required|is_unique[Clientes.nombre_cliente]',
				'errors' => [
					'required' => '{field} es requerido',
					'alpha_numeric' => '{field} solo puede tener numeros y letras.',
					'is_unique' => 'Este nombre legal ya este registrado, favor de verificar.'
				]
			],
			'pais' => [
				'label' => 'pais',
				'rules' => 'required|not_in_list[0]',
				'errors' => [
					'required' => 'El {field} es requerido.',
					'not_in_list' => 'El {field} es obligatorio.'
				]
			],
			'telefono' => [
				'label' => 'Nombre corto',
				'rules' => 'required|numeric|max_length[10]',
				'errors' => [
					'required' => '{field} es requerido',
					'numeric' => '{field} solo puede tener n&uacute;meros.',
					'max_length' => '{field} solo puede tener 10 numeros'
				]
			],
			'ciudad' => [
				'label' => 'Ciudad',
				'rules' => 'required|alpha_space',
				'errors' => [
					'required' => '{field} es requerido',
					'alpha_space' => '{field} solo puede tener letras.'
				]
			]
		]);
		if(!$validations)
		{
			$session = \Config\Services::session();
			if (!isset($_SESSION['id'])) {
				return redirect()->to('/auth/register/');
			}
			$paises = new PaisesModel();
			$data = $paises->findAll();
			$header['titulo'] = "LTE | Crear nueva Compa&ntilde;ia";
			echo view('auth/headerAuth',$header);
			echo view('auth/new', [
                'validation' => $this->validator,
				'nombre_corto' => htmlspecialchars($_POST['nombre_corto']),
				'legal' => htmlspecialchars($_POST['legal']),
				'ciudad' => htmlspecialchars($_POST['ciudad']),
				'telefono' => htmlspecialchars($_POST['telefono']),
				'paises' => $data
            ]);
			echo view('auth/footerAuth');
		} else {
			$clientes = new ClientesModel();
			$data = [
				'nombre_cliente' => htmlspecialchars($_POST['legal']),
				'corto_cliente' => htmlspecialchars($_POST['nombre_corto']),
				'fecha_creacion' => ControlProyectosLib::get_fecha_hora_today(),
				'ultima_conexion' => ControlProyectosLib::get_fecha_hora_today(),
				'ciudad' => htmlspecialchars($_POST['ciudad']),
				'telefonno' => htmlspecialchars($_POST['telefono']),
				'fecha_inicio_plan' => ControlProyectosLib::get_fecha_hora_today(),
				'fecha_fin_plan' => ControlProyectosLib::get_fecha_mas_mes(),
				'Paises_idPaises' => htmlspecialchars($_POST['pais']),
				'Planes_idPlanes' => 1
			];
			try {
				$clientes->insert($data);
				$idCompany = $clientes->insertID();
				$session = \Config\Services::session();
				$session->set('idCompany',$idCompany);
				$ClientesUsuarios = new ClientesUsuariosModel();
				$data2 = [
					'Usuarios_idUsuarios' => $_SESSION['id'],
					'Clientes_idClientes' => $idCompany,
					'Roles_idRoles' => 1
				];
				$ClientesUsuarios->insert($data2);
				$model = new UsuariosModel();
				$datos = $model->getUsuarioxCampo('idUsuarios',$_SESSION['id'],'nombre_usuario,apellido_usuario,correo_usuario');
				var_dump($datos);
				$data3 = [
					'idColaboradores' => $_SESSION['id'],
					'nombre_colab' => $datos[0]['nombre_usuario'],
					'apellido_colab' => $datos[0]['apellido_usuario'],
					'Rol_idRol' => 1,
					'EmpresaId' => $idCompany,
					'correo_colab' => $datos[0]['correo_usuario']
				];
				$model2 = new ColabsModel();
				$model2->insert($data3);
				return redirect()->to('/auth/register/end/');
			} catch (\Exception $e) {
				die($e->getMessage());
				//throw new \CodeIgniter\Database\Exceptions\DatabaseException();
			}
		}
	}

	public function join()
	{
		$session = \Config\Services::session();
		if (!isset($_SESSION['id'])) {
			return redirect()->to('/auth/register/');
		}
		$header['titulo'] = "LTE | Unirte a una Compa&ntilde;ia";
		echo view('auth/headerAuth',$header);
		echo view('auth/join');
		echo view('auth/footerAuth');
	}

	public function check_if_exist()
	{
		$validations = $this->validate([
			'nombre_corto' => [
				'label' => 'Nombre corto',
				'rules' => 'required|alpha_numeric|is_not_unique[Clientes.corto_cliente]',
				'errors' => [
					'required' => '{field} es requerido',
					'alpha_numeric' => '{field} solo puede tener numeros y letras.',
					'is_not_unique' => 'Empresa no existe con este nombre, favor de verificar.'
				]
			]
		]);
		if(!$validations)
		{
			$session = \Config\Services::session();
			if (!isset($_SESSION['id'])) {
				return redirect()->to('/auth/register/');
			}
			$header['titulo'] = "LTE | Crear nueva Compa&ntilde;ia";
			echo view('auth/headerAuth',$header);
			echo view('auth/join');
			echo view('auth/footerAuth');
		} else {
			$session = \Config\Services::session();
			if (!isset($_SESSION['id'])) {
				return redirect()->to('/auth/register/');
			}
			$clientes = new ClientesModel();
			try {
				$info = $clientes->getClientexCampo('corto_cliente','netheads','idClientes,nombre_cliente');
				foreach ($info as $i)
				{
					$nombre_cliente = $i['nombre_cliente'];
					$idCliente = $i['idClientes'];
				 }
				$data['nombre_cliente'] = $nombre_cliente;
				$data['idCliente'] = $idCliente;
				$header['titulo'] = "LTE | Confirmar Unirse a una Empresa";
				echo view('auth/headerAuth',$header);
				echo view('auth/confirm',$data);
				echo view('auth/footerAuth');
			} catch (\Exception $e) {
				throw new \CodeIgniter\Database\Exceptions\DatabaseException();
			}

		}
	}

	public function confirmjoin()
	{
		try {
			$session = \Config\Services::session();
			$ClientesUsuarios = new ClientesUsuariosModel();
			$data = [
				'Usuarios_idUsuarios' => $_SESSION['id'],
				'Clientes_idClientes' => htmlspecialchars($_POST['idEmpresa']),
				'Roles_idRoles' => 2
			];
			$ClientesUsuarios->insert($data);
			$solicitudes = new SolicitudesModel();
			$data2 = [
				'nombre_sol' => '',
				'apellido_sol' => '',
				'correo_sol' => '',
				'fecha_sol' => '',
				'iniciado_por' => 0
			];
			$solicitudes->insert($data2);
			return redirect()->to('/auth/register/end/');
		} catch (\Exception $e) {
			die($e->getMessage());
			//throw new \CodeIgniter\Database\Exceptions\DatabaseException();
		}
	}

	public function end()
	{
		$session = \Config\Services::session();
		if (!isset($_SESSION['id'])) {
			return redirect()->to('/auth/register/');
		}
		$header['titulo'] = "LTE | Gracias por unirte";
		echo view('auth/headerAuth',$header);
		echo view('auth/end');
		echo view('auth/footerAuth');
	}
}