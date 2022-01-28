<?php

class DaoReserva{


private $db;

public function __construct()
    {
        $this->db = new DataBase();
    }

    public function existeReserva($aula, $fecha, $horaHasta){

    }

    public function insertarAlumno($reserva){
        $this->db->conectar();
        try {
            $sql = "INSERT INTO reservas () VALUES (?, ?)";
        } catch (Exception $ex) {
            //throw $th;
        }
    }

}
