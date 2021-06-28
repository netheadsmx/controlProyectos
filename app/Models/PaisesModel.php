<?php 
namespace App\Models;
use CodeIgniter\Model;

class PaisesModel extends  Model {

    protected $table = 'Paises';
    protected $primaryKey = 'idPaises';
    protected $returnType = 'array';
    protected $allowedFields = ['idPais,nombre_pais,abreviatura,codigo'];
    
    
}