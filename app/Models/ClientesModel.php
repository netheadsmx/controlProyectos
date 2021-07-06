<?php 
namespace App\Models;
use CodeIgniter\Model;

class ClientesModel extends  Model {

    protected $table = 'Clientes';
    protected $primaryKey = 'idClientes';
    protected $returnType = 'array';
    protected $allowedFields = ['nombre_cliente','corto_cliente','fecha_creacion','ultima_conexion','ciudad','telefono','fecha_inicio_plan','fecha_fin_plan','Paises_idPaises','Planes_idPlanes'];

    //devolver = campo que se va a devolver, puede ser *
    //campo = campo que se va a buscar
    //valorcampo = valor que se va a comparar
    public function getClientexCampo($campo, $valorcampo, $devolver)
    {
        return $this->asArray()
                    ->select($devolver)
                    ->where([$campo=>$valorcampo])
                    ->find();
    }

}