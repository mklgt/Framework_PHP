<?php
class ValidadorForm
{

    private $errores = [];
    private $reglasValidacion = null;
    private $valido = false;

    public function __construct()
    {
    }

    public function validar($fuente, $reglasValidacion)
    {

        foreach ($reglasValidacion as $campo => $valores) {
            if (isset($fuente[$campo])) {
                $campoAValidar = $fuente[$campo];
                foreach ($valores as $regla => $valorRegla) {
                    if ($regla == "min") {
                        if (!($campoAValidar >= $valorRegla)) {
                            $this->addError($campo, "tiene que tener más de 8 carácteres");
                        }
                    }
                    
                }
            }else{
                $this->addError($campo, "requerido");
            }
        }
        return null;
    }

    public function addError($nombreCampo, $error)
    {
        $this->errores[] = "El valor " . $nombreCampo . " es " . $error;
    }

    public function esValido()
    {
        return $this->valido;
    }
}
