<?php
include 'DataBase.php';
class DaoReserva
{


    private $db;

    public function __construct()
    {
        $this->db = new DataBase();
    }

    public function existeReserva($reserva)
    {
        $this->db->conectar();
        try {
            $sql = "CALL `aulasReservadas`(?, ?, ?, ?); ";
            $args = array($reserva->getAula(), $reserva->getfecha(), $reserva->getHoraDesde(), $reserva->getHoraHasta());
            $result = $this->db->ejecutarSqlActualizacion($sql, $args);
            //echo($result->fetchAll(PDO::FETCH_ASSOC)[0]['COUNT(*)']) ;
            if ($result->fetchAll(PDO::FETCH_ASSOC)[0]['COUNT(*)'] == 0) {
                return false;
            } else {
                return true;
            }
        } catch (Exception $ex) {
            echo "Error al reservar -> $ex->getMessage()";
        }
        $this->db->desconectar();
    }

    public function insertarReserva($reserva)
    {
        $this->db->conectar();
        try {
            $sql = "INSERT INTO reservas (usuario, aula, fecha, horaDesde, horaHasta) VALUES (?, ?, ?, ?, ?)";
            $args = array($reserva->getUsuario(), $reserva->getAula(), $reserva->getfecha(), $reserva->getHoraDesde(), $reserva->getHoraHasta());
            $this->db->ejecutarSqlActualizacion($sql, $args);
        } catch (Exception $ex) {
            echo "Error al reservar -> $ex->getMessage()";
        }
        $this->db->desconectar();
    }
}
