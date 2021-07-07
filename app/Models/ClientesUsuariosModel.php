<?php 
namespace App\Models;
use CodeIgniter\Model;

class ClientesUsuariosModel extends  Model {

    protected $table = 'Clientes_has_Usuarios';
    protected $returnType = 'array';
    protected $allowedFields = ['Clientes_idClientes','Usuarios_idUsuarios','Planes_idPlanes','Roles_idRoles'];

    public function validarUsuarioCliente($usuario,$cliente)
    {
        try {
            $var = $this->asArray()
                        ->where(['Usuarios_idUsuarios' => $usuario])
                        ->where(['Clientes_idClientes' => $cliente])
                        ->find();            
            if ($var) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            die($e->getMessage());
				//throw new \CodeIgniter\Database\Exceptions\DatabaseException();
        }

    }
}