<?php 
namespace App\Models;
use CodeIgniter\Model;

class ColabsModel extends  Model {
    protected $DBGroup = 'proyectos';
    protected $table = 'Colaboradores';
    protected $primaryKey = 'idColaboradores';
    protected $returnType = 'array';
    protected $allowedFields = ['nombre_colab','apellido_colab','Rol_idRol','EmpresaId','correo_colab','Estados_idEstados','activado','ultimo_cambio'];

    public function getColabInfo()
    {
        try {
            $sql = 'SELECT C.*, T.nombre_tipousuario FROM Colaboradores as C INNER JOIN TipoUsuarios as T where C.TipoUsuarios_idTipoUsuarios=T.idTipoUsuarios AND C.Estados_idEstados=1 OR C.Estados_idEstados=2 OR C.Estados_idEstados=3;';
            $query = $this->query($sql);
            $result = $query->getResultArray();
            return $result;
        } catch (\Exception $e) {
            die($e->getMessage());
            //throw new \CodeIgniter\Database\Exceptions\DatabaseException();
        }
    }

    public function getColabxId($id)
    {
        try {
            $sql = 'SELECT * FROM Colaboradores where idColaboradores='.$id;
            $query = $this->query($sql);
            $result = $query->getResultArray();
            return $result;
        } catch (\Exception $s) {
            die($e->getMessage());
            //throw new \CodeIgniter\Database\Exceptions\DatabaseException();
        }
    }

    public function updateColabxId($id, $data)
    {
        try {
            $this->where('idColaboradores',$id);
            if ($this->update($id,$data)) {
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