<?php
/**
 * 
 */
class Reserva
{

    private $usuario;
    private $aula;
    private $fecha;
    private $horaDesde;
    private $horaHasta;

    public function __construct($usuario, $aula, $fecha, $horaDesde, $horaHasta)
    {
        $this->usuario = $usuario;
        $this->aula = $aula;
        $this->fecha = $fecha;
        $this->horaDesde = $horaDesde;
        $this->horaHasta = $horaHasta;
    }


    //GETTERS
    public function getUsuario()
    {
        return $this->usuario;
    }

    public function getAula()
    {
        return $this->aula;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function getHoraDesde()
    {
        return $this->horaDesde;
    }

    public function getHoraHasta()
    {
        return $this->horaHasta;
    }


    //SETTERS
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    public function setAula($aula)
    {
        $this->aula = $aula;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    public function setHoraDesde($horaDesde)
    {
        $this->horaDesde = $horaDesde;
    }

    public function setHoraHasta($horaHasta)
    {
        $this->horaHasta = $horaHasta;
    }
}
