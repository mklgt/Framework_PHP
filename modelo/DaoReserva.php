<?php
//include 'DataBase.php';
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

    public function comprobarSesion($usuario, $contraseña)
    {
        $this->db->conectar();
        $args = [$usuario, $contraseña];
        $sql = "call comprobarSesion(?, ?)";
        $resultado = $this->db->ejecutarSqlActualizacion($sql, $args)->fetchAll();
        if (!empty($resultado)) {
            return true;
        }
        return false;
    }

    public function consultarAulas()
    {
        $this->db->conectar();
        $sql = "SELECT nombre FROM aula";
        $resultado = ($this->db->ejecutarSql($sql))->fetchAll();
        return $resultado;
    }

    public function consultarHoras()
    {
        $this->db->conectar();
        $sql = "SELECT horaEntrada FROM tramo";
        $resultado = ($this->db->ejecutarSql($sql))->fetchAll();
        return $resultado;
    }

    public function mostrarReservas($usuario)
    {
        $this->db->conectar();
        if ($usuario == "*") {
            $sql = "SELECT id, usuario, aula, fecha, horaDesde, horaHasta, motivo FROM reservas";
        } else {
            $sql = "SELECT id, aula, fecha, horaDesde, horaHasta, motivo FROM reservas WHERE usuario = '$usuario'";
        }
        
        $resultado = ($this->db->ejecutarSql($sql))->fetchAll();

        return $resultado;
    }

    public function eliminarReserva($id)
    {
        $this->db->conectar();
        $sql = "DELETE FROM reservas WHERE id = '$id'";
        $this->db->ejecutarSql($sql);
    }


     /**
     * Recibe la reserva y simplemente hace una conulta de tipo INSERT
     * @param  Reserva $reserva
     * @return boolean true o false dependiendo del resultado de la consulta
     */
    public function existeReserva($reserva)
    {
        $this->db->conectar();
        //CONSULTAR LA TABLA OCUPADAS: if() then SI está ocupada return true else() ver aulasReservas (lo que hay de código)

        try {
            $sql = "CALL `aulasReservadas`(?, ?, ?, ?); ";
            $args = array($reserva->getAula(), $reserva->getfecha(), $reserva->getHoraDesde(), $reserva->getHoraHasta());
            $result = $this->db->ejecutarSqlActualizacion($sql, $args);

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
            $sql = "INSERT INTO reservas (usuario, aula, fecha, horaDesde, horaHasta, motivo) VALUES (?, ?, ?, ?, ?, ?)";
            $args = array($reserva->getUsuario(), $reserva->getAula(), $reserva->getfecha(), $reserva->getHoraDesde(), $reserva->getHoraHasta(), $reserva->getMotivo());
            $this->db->ejecutarSqlActualizacion($sql, $args);
        } catch (Exception $ex) {
            echo "Error al reservar -> $ex->getMessage()";
        }
        $this->db->desconectar();
    }

    /**
     * Consulta la tabla de reservas para comprobar las disponibles en la fecha especificada
     */
    public function consultarFechaAula($fecha, $aula)
    {
        $this->db->conectar();
        $sql = "SELECT horaDesde, horaHasta, usuario FROM reservas WHERE fecha = '$fecha' AND aula = '$aula'";

        $consulta = $this->consultarHoras();
        $horasTotales = [];
        foreach ($consulta as $horas => $hora) {
            foreach ($hora as $valor) {
                $valor = substr($valor, 0, -3);
                if (!in_array($valor, $horasTotales)) {
                    $horasTotales[] = $valor; 
                }                
            }
        }
        asort($horasTotales);
        $resultado = ($this->db->ejecutarSql($sql))->fetchAll();
        $horasOcupadas = array();
        $datosTotales = array();
        foreach ($resultado as $datos) {
            foreach ($datos as $dato) {
                if (strlen($dato) > 8) {
                    $usuario = $dato;
                } else {
                    // Cambiar en clase
                    $hora = substr($dato, 0, -3);
                    //$hora = $dato;
                    if (!in_array($hora, $horasOcupadas)) {
                        $horasOcupadas[] = $hora;
                        if (!isset($inicio)) {
                            $inicio = array_search($hora, $horasTotales);
                        } else {
                            $final = (array_search($hora, $horasTotales)) - ($inicio - 1) ;
                            $horasDeshabilitadas = array_slice($horasTotales, $inicio, $final);
                            array_pop($horasDeshabilitadas);
                            $inicio = null;
                        }
                    } 
                }
            }
            $datosTotales[] = array(
                "usuario" => $usuario,
                "horasOcupadas" => $horasDeshabilitadas
            );
            $horasOcupadas = [];
        }
        
        return $datosTotales;
        
    }
    
    
/**
     * Recibe la reserva y  hace una conulta de tipo INSERT
     * @param  Reserva $reserva
     * @return void Esta función no devuelve nada pero si hay algun tipo de error devuelve el
     * mensaje del catch
     */
   /*  Movido a DaoXML public function insertarDatosArchivoXML()
    {
        $this->db->conectar();
        $this->db->desconectar();
    }
     */
}
