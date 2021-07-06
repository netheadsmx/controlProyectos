<?php 
namespace App\Models;
use CodeIgniter\Model;

class ClientesUsuariosModel extends  Model {

    protected $table = 'Clientes_has_Usuarios';
    protected $returnType = 'array';
    protected $allowedFields = ['Clientes_idClientes','Usuarios_idUsuarios','Planes_idPlanes','Roles_idRoles'];
}