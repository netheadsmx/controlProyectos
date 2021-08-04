<?php
namespace App\Models;
use CodeIgniter\Model;

class UsuariosModel extends Model {
    protected $table = 'Usuarios';
    protected $primaryKey = 'idUsuarios';
    protected $returnType = 'array';
    protected $allowedFields = ['nombre_usuario','apellido_usuario','correo_usuario','password_usuario','valido_usuario','ultima_conexion','Paises_idPaises'];

    public function getUsuarioxCampo($campo, $valorcampo, $devolver)
    {
        try {
            return $this->asArray()
            ->select($devolver)
            ->where([$campo=>$valorcampo])
            ->find();
        } catch (\Exception $e) {
            die($e->getMessage());
			//throw new \CodeIgniter\Database\Exceptions\DatabaseException();
        }
    }

    public function updateUsuarioxCampo($id, $data)
    {
        try {
            $this->update($id,$data);
        } catch(\Exception $e) {
            die($e->getMessage());
			//throw new \CodeIgniter\Database\Exceptions\DatabaseException();
        }
    }

}