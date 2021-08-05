<?php

namespace App\Controllers;
use App\Libraries\ControlProyectosLib; //Libreria personalizada
use App\Models\UsuariosModel;
use App\Models\ClientesModel;
use App\Models\ClientesUsuariosModel;
use CodeIgniter\I18n\Time;
use App\Models\ColabsModel;

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

    public function testpwd()
    {
        if (ControlProyectosLib::validate_password('Admin1234567890','$2y$12$/WDdsCOzRItb8st9glAeDeCdtW8L6NhxFWjCGSQeB8hRTv8//bmxy'))
        { 
            echo 'TRUE';
        } else {
            echo 'FALSE';
        }
    }

    public function encriptpwd()
    {
        echo ControlProyectosLib::encript_password('Admin1234567890');
    }

    public function update()
    {
        $new = new UsuariosModel();
        $newdata = [
            'nombre_usuario' => 'Gonzalo Jesus'
        ];
        try {
            $new->updateUsuarioxCampo('idUsuarios',27,$newdata);
            echo 'Ok';
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    public function colabs()
    {
        $model = new ColabsModel();
        $colabs = $model->getColabInfo();
        var_dump($colabs);
    }

    public function validate_invitacion_correo () {
        try {
            $usuario = new UsuariosModel();
            $idUsuario = $usuario->getUsuarioxCampo('correo_usuario','jp@netheads.com.mx','idUsuarios');
            //Si el correo no esta registrado, se puede enviar la invitacion, si esta registrado entonces
            //se valida que este registrado con la compania.
            var_dump($idUsuario);
            if ($idUsuario) {
                $id = $idUsuario[0]['idUsuarios'];
                $cia = new ClientesUsuariosModel();
                if ($cia->validarUsuarioCliente($id,6)) {
                    //Si la compania ya tiene registrado al usuario, entonces arrojar un error para no enviar invitacion
                    //return false;
                    echo "IF 1";
                } else {
                    echo "IF 2";
                    //return true;
                }
            } else {
                echo "IF 3";
                //return true;
            }
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    public function enviar_correo()
    {
        
        $data = 'https://www.netheads.com.mx';
        $message = "Please activate the account ".anchor('user/activate/'.$data,'Activate Now','');
        $email = \Config\Services::email();
        $email->setFrom('no-reply@netheads.com.mx', 'ControlProyectos');
        $email->setTo('gonzalo.rodriguezh@outlook.com');
        $email->setSubject('Titulo del correo | tutsmake.com');
        $email->setMessage($message);//your message here
      
        //$email->setCC('another@emailHere');//CC
        //$email->setBCC('thirdEmail@emialHere');// and BCC
        //$filename = '/img/yourPhoto.jpg'; //you can use the App patch 
        //$email->attach($filename);
         
        if($email->send()) {
            echo "FUNCIONO";
            var_dump($email);
        } else {
            echo "NO FUNCIONO";
            var_dump($email);
            //$email->printDebugger();
        }

        /*
        $to      = 'gonzalo.rodriguezh@outlook.com';
        $subject = 'the subject';
        $message = 'hello';
        $headers = 'From: no-reply@netheads.com.mx'       . "\r\n" .
                    'Reply-To: no-reply@netheads.com.mx' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, $headers);
        */
    }

    public function phpconfig()
    {
        phpinfo();
    }
}
