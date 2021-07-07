<?php

/**
 * This file is part of the CodeIgniter 4 framework.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CodeIgniter\Validation;

use CodeIgniter\HTTP\RequestInterface;
use Config\Mimes;
use Config\Services;
use App\Models\UsuariosModel;
use App\Models\ClientesModel;
use App\Models\ClientesUsuariosModel;
use App\Libraries\ControlProyectosLib; //Libreria personalizada
/**
 * File validation rules
 */
class CustomeRules
{
    public function validate_password($password)
	{
		$regex = '/^\S*(?=\S{12,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/';
        if (preg_match($regex,$password)) {
            return true;
        } else {
            return false;
        }
	}

    public function validate_cliente_usuario($correo)
    {
        try {
            $usuario = new UsuariosModel();
            $idUsuario = $usuario->getUsuarioxCampo('correo_usuario',$_POST['email'],'password_usuario');
            if ($idUsuario) {
                $hash = $idUsuario[0]['password_usuario'];
                if (ControlProyectosLib::validate_password($_POST['password'],$hash))
                {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }
}