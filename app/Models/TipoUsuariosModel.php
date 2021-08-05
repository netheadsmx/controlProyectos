<?php 
namespace App\Models;
use CodeIgniter\Model;

class TipoUsuariosModel extends  Model {

    protected $DBGroup = 'proyectos';
    protected $table = 'TipoUsuarios';
    protected $primaryKey = 'idTipoUsuarios';
    protected $returnType = 'array';
    protected $allowedFields = ['idTipoUsuarios','nombre_tipousuarios','descripcion'];
}