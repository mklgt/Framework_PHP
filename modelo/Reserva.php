<?php
class Reserva
{

    private $usuario;
    private $aula;
    private $fecha;
    private $horaDesde;
    private $horaHasta;
    private $motivo;

    public function __construct($usuario, $aula, $fecha, $horaDesde, $horaHasta, $motivo)
    {
        $this->usuario = $usuario;
        $this->aula = $aula;
        $this->fecha = $fecha;
        $this->horaDesde = $horaDesde;
        $this->horaHasta = $horaHasta;
        $this->motivo = $motivo;
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

    public function getMotivo()
    {
        return $this->motivo;
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

    public function setMotivo($motivo)
    {
        $this->motivo = $motivo;
    }
}
