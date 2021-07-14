<?php 
namespace App\Models;
use CodeIgniter\Model;

class ColabsModel extends  Model {
    protected $DBGroup = 'proyectos';
    protected $table = 'Colaboradores';
    protected $primaryKey = 'idColaboradores';
    protected $returnType = 'array';
    protected $allowedFields = ['nombre_colab','apellido_colab','Rol_idRol','EmpresaId'];


    public function getColabInfo()
    {
        try {
            $sql = 'SELECT idColaboradores,nombre_colab,apellido_colab,correo_colab,nombre_rol FROM Colaboradores as C INNER JOIN Rol as R where C.Rol_idRol=R.idRol;';
            $query = $this->query($sql);
            $result = $query->getResultArray();
            return $result;
        } catch (\Exception $s) {
            die($e->getMessage());
            //throw new \CodeIgniter\Database\Exceptions\DatabaseException();
        }
    }
}