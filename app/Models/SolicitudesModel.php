<?php 
namespace App\Models;
use CodeIgniter\Model;

class SolicitudesModel extends  Model {
    protected $DBGroup = 'proyectos';
    protected $table = 'Solicitudes';
    protected $primaryKey = 'idSolicitudes';
    protected $returnType = 'array';
    protected $allowedFields = ['idSolicitudes','nombre_sol','apellido_sol','correo_sol','fecha_sol','iniciado_por','Empresa_sol'];

    public function getSolicitudes($campo, $valorcampo, $devolver)
    {
        return $this->asArray()
                    ->select($devolver)
                    ->where([$campo=>$valorcampo])
                    ->find();
    }
    
}