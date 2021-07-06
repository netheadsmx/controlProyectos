<?php
namespace App\Models;
use CodeIgniter\Model;

class UsuariosModel extends Model {
    protected $table = 'Usuarios';
    protected $primaryKey = 'idUsuarios';
    protected $returnType = 'array';
    protected $allowedFields = ['nombre_usuario','apellido_usuario','correo_usuario','password_usuario','valido_usuario','ultima_conexion','Paises_idPaises'];
}