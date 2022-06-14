<?php
include 'DataBase.php';
set_time_limit(300);
/**
 * @method existeReserva($reserva)
 * @method insertarReserva($reserva)
 */
class DaoSession
{
    
    private $db;

    public function __construct()
    {
        $this->db = new DataBase();
    }

    public function comprobarSesion($usuario, $contraseña)
    {
        $this->db->conectar('no');
        $args = [$usuario, $contraseña];
        $sql = "call comprobarSesion(?, ?)";
        $resultado = $this->db->ejecutarSqlActualizacion($sql, $args)->fetchAll();
        if (!empty($resultado)) {
            return true;
        }
        return false;
    }
}
