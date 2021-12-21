<?php
class Validator
{

    private $errores = [];
    private $reglasValidacion = null;
    private $valido = false;

    public function __construct()
    {
    }

    public function validar($fuente, $reglasValidacion)
    {
        return null;
    }

    public function addError($nombreCampo, $error){
        return null;
    }

    public function esValido(){
        //return $valido;
    }
}
