<?php

class Reserva
{

    private $id;
    private $usuario;
    private $aula;
    private $fecha;
    private $horaDesde;
    private $horaHasta;

    public function __construct($usuario, $aula, $fecha, $horaDesde, $horaHasta)
    {
        //funcionara?? (para crear un id unico)
        //Tambien se puede usar -> insert tabla (id, ...) values (UUID(), ...)
        $this->id = com_create_guid();
        $this->usuario = $usuario;
        $this->aula = $aula;
        $this->fecha = $fecha;
        $this->horaDesde = $horaDesde;
        $this->horaHasta = $horaHasta;
    }

    public function mutadores()
    {
    }
    public function accesores()
    {
    }
}

?>
