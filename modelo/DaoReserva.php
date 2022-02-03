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
        //crear procedimiento almacenado
    }

    public function insertarReserva($reserva)
    {
        $this->db->conectar();
        try {
            //Ejemplo
            //INSERT INTO `reservas` (`id`, `usuario`, `aula`, `fecha`, `horaDesde`, `horaHasta`) VALUES (NULL, 'mgoicoeoca', 'A02', '2022-02-04', '11:00:00', '11:55:00');
            $sql = "INSERT INTO reservas (usuario, aula, fecha, horaDesde, horaHasta) VALUES (?, ?, ?, ?, ?)";
            $args = array($reserva->getUsuario(), $reserva->getAula(), $reserva->getfecha(), $reserva->getHoraDesde(), $reserva->getHoraHasta());
            $this->db->ejecutarSqlActualizacion($sql, $args);
        } catch (Exception $ex) {
            echo "Error al reservar -> $ex->getMessage()";
        }
    }
}
 