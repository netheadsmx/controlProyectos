<?php

namespace App\Controllers\Auth;
use App\Controllers\BaseController;
use App\Models\UsuariosModel;
use App\Models\ClientesModel;
use App\Models\ClientesUsuariosModel;
use App\Libraries\ControlProyectosLib; //Libreria personalizada

class Login extends BaseController
{

	public function __construct() 
	{
		helper(['url']);
	}

    public function index()
    {
		$header['titulo'] = "LTE | Iniciar sesi&oacute;n";
		echo view('auth/headerAuth',$header);
		echo view('auth/login');
		echo view('auth/footerAuth');
    }

    public function check_user()
    {
        $validations = $this->validate([
            'email' => [
				'label' => 'Correo electronico',
				'rules' => 'required|valid_email',
				'errors' => [
					'required' => '{field} es requerido.',
                    'valid_email' => '{field} no es valido.'
				]
			],
            'password' => [
				'label' => 'Password',
				'rules' => 'required|validate_cliente_usuario',
				'errors' => [
					'required' => '{field} es requerido',
					'validate_cliente_usuario' => 'Credenciales incorrectas, favor de verificar.'
				]
			],
        ]);
        if(!$validations)
		{
            $header['titulo'] = "LTE | Iniciar sesi&oacute;n";
            echo view('auth/headerAuth',$header);
            echo view('auth/login');
            echo view('auth/footerAuth',[
                'validation' => $this->validator
            ]);
        } else {
			$session = \Config\Services::session();
			$usuario = new UsuariosModel();
			$info_u = $usuario->getUsuarioxCampo('correo_usuario',htmlspecialchars($_POST['email']),'idUsuarios,nombre_usuario,apellido_usuario,correo_usuario,Paises_idPaises,valido_usuario');
			$cliente = new ClientesUsuariosModel();
			$info_c = $cliente->getUsuarioClienteCampo('Usuarios_idUsuarios',$info_u[0]['idUsuarios'],'Clientes_idClientes');
			$session->set('nmUsr',$info_u[0]['nombre_usuario']);
			$session->set('lstUsr',$info_u[0]['apellido_usuario']);
			$session->set('email',$info_u[0]['correo_usuario']);
			$session->set('idUsr',$info_u[0]['idUsuarios']);
			$session->set('cntrUsr',$info_u[0]['Paises_idPaises']);
			$session->set('vldUsr',$info_u[0]['valido_usuario']);
			$session->set('cmpnId',$info_c[0]['Clientes_idClientes']);
			$data = [
				'ultima_conexion' => ControlProyectosLib::get_fecha_hora_today()
			];
			$usuario->updateUsuarioxCampo($info_u[0]['idUsuarios'],$data);
			return redirect()->to("/dashboard/start");
        }
    }
}