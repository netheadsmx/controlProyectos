<?php

namespace App\Controllers\Auth;
use App\Controllers\BaseController;
use App\Models\PaisesModel;

class Register extends BaseController
{
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
		$Usuarios = new UsuariosModel();
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
					'valid_email' => 'El {field} no es valido'
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

			echo view('auth/headerAuth',$header);
			echo view('auth/register', [
                'validation' => $this->validator,
				'nombre' => htmlspecialchars($_POST['nombre']),
				'apellidos' => htmlspecialchars($_POST['apellidos']),
				'email' => htmlspecialchars($_POST['email'])
            ]);
			echo view('auth/footerAuth');
		} else {
			echo view('welcome_message');
		}
	}
}