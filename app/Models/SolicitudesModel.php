<?php 
namespace App\Models;
use CodeIgniter\Model;

class SolicitudesModel extends  Model {
    protected $DBGroup = 'proyectos';
    protected $table = 'Solicitudes';
    protected $primaryKey = 'idSolicitudes';
    protected $returnType = 'array';
    protected $allowedFields = ['idSolicitudes','nombre_sol','apellido_sol','correo_sol','fecha_sol','iniciado_por','Empresa_sol','tipo'];

    public function getSolicitudes($campo, $valorcampo, $devolver)
    {
        return $this->asArray()
                    ->select($devolver)
                    ->where([$campo=>$valorcampo])
                    ->find();
    }



    public function getSolicitudxEmpresaCorreo($correo,$empresa) {
        try {
            return $this->asArray()
            ->select('idSolicitudes')
            ->where(['correo_sol'=>$correo])
            ->where(['Empresa_sol'=>$empresa])
            ->find();
        } catch (\Exception $e) {
            die($e->getMessage());
			//throw new \CodeIgniter\Database\Exceptions\DatabaseException();
        }
    }

    public function checkSolicitudValida($id,$empresa) {
        try {
            $sql ="SELECT * FROM Solicitudes where idSolicitudes=".$id." AND Empresa_sol=".$empresa." AND tipo='S'";
            $query = $this->query($sql);
            $result = $query->getResultArray();
            return $result;
        } catch (\Exception $e) {
            die($e->getMessage());
			//throw new \CodeIgniter\Database\Exceptions\DatabaseException();
        }
    }

    public function eliminarSolicitud($id) {
        try {
            $this->where(['idSolicitudes'=>$id])
                 ->delete();
            return true;
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

}