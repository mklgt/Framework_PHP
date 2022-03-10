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

    /**
     * Consulta la tabla de reservas
     */
    public function consultarFechaAula($fecha, $aula)
    {
        $this->db->conectar();
        $sql = "SELECT horaDesde, horaHasta FROM reservas WHERE fecha = '$fecha' AND aula = '$aula'";
        //$args = array($fecha, $aula);
        $horasTotales = ['08:30', '09:25', '10:20', '11:15', '11:45', '12:40', '13:35', '14:30', '15:25', '16:20', '17:15', '18:10', '19:05', '20:00', '21:00'];
        $resultado = ($this->db->ejecutarSql($sql))->fetchAll();
        $horasOcupadas = array();
        $horasDeshabilitadas = array();
        foreach ($resultado as $horas) {
            foreach ($horas as $hora) {
                $hora = substr($hora, 0, -3);
                if (!in_array($hora, $horasOcupadas)) {
                    $horasOcupadas[] = $hora;
                }    
            }
        }
        $desde = 0;
        
        for ($pos=0; $pos < count($horasOcupadas); $pos++) { 
            if ($pos % 2 == 0) {
                $desde = array_search($horasOcupadas[$pos], $horas);
            } else {
                $hasta = array_search($horasOcupadas[$pos], $horasTotales);
                echo $desde . "-" . $hasta;
                $horasDeshabilitadas = array_slice($horasTotales, $desde, $hasta);
            }
            
            
        }
        return $horasDeshabilitadas;
        
    }
    
    
/**
     * Recibe la reserva y simplemente hace una conulta de tipo INSERT
     * @param  Reserva $reserva
     * @return void Esta función no devuelve nada pero si hay algun tipo de error devuelve el
     * mensaje del catch
     */
    public function insertarXML($reserva)
    {
        $this->db->conectar();
        try {
            $this->db->createDb(DB_NAME);
            $this->db->createTables();
            $this->db->consultarInformacion();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        $this->db->desconectar();
    }
    
}
