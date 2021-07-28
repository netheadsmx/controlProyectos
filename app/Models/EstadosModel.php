<?php 
namespace App\Models;
use CodeIgniter\Model;

class EstadosModel extends  Model {
    protected $DBGroup = 'proyectos';
    protected $table = 'Estados';
    protected $primaryKey = 'idEstados';
    protected $returnType = 'array';
    protected $allowedFields = ['idEstados','nombre','descripcion'];
}