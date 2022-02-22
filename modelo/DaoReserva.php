<?php
include 'DataBase.php';
set_time_limit(300);
/**
 * @method existeReserva($reserva)
 * @method insertarReserva($reserva)
 */
class DaoReserva
{
    

    private $db;

    public function __construct()
    {
        $this->db = new DataBase();
    }

     /**
     * Recibe la reserva y simplemente hace una conulta de tipo INSERT
     * @param  Reserva $reserva
     * @return boolean true o false dependiendo del resultado de la consulta
     */
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

    /**
     * Recibe la reserva y simplemente hace una conulta de tipo INSERT
     * @param  Reserva $reserva
     * @return void Esta función no devuelve nada pero si hay algun tipo de error devuelve el
     * mensaje del catch
     */
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
