<?php
class ValidadorForm
{

    private $errores = [];
    //private $reglasValidacion = null;
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
<<<<<<< HEAD

                    switch ($regla) {
                        case 'required':

=======
                    
                    switch ($regla) {
                        case 'required':
                            echo "<br>El campo a validar: $campoAValidar ". strlen($campoAValidar);
>>>>>>> 75d28b9739d6e9f2b803ed6a8287fcdfafa56765
                            if (is_null($campoAValidar) || empty($campoAValidar)) {
                                $this->addError($campo, "Es requerido");
                            }
                            break;

                        case 'min':
<<<<<<< HEAD
                            if (strtotime($campoAValidar)) {
                                if (strtotime($campoAValidar) < strtotime($valorRegla)) {
                                    $this->addError($campo, "Debe ser mayor que " . $valorRegla);
                                }
                            } else {
                                if (strlen($campoAValidar) < $valorRegla) {
                                    $this->addError($campo, "Debe ser mayor que " . $valorRegla);
                                }
=======
                            if (strlen($campoAValidar) < $valorRegla || $campoAValidar < $valorRegla) {
                                $this->addError($campo, "Debe ser mayor que " . $valorRegla);
>>>>>>> 75d28b9739d6e9f2b803ed6a8287fcdfafa56765
                            }
                            break;

                        case 'max':
<<<<<<< HEAD
                            if (strtotime($campoAValidar)) {
                                if (strtotime($campoAValidar) > strtotime($valorRegla)) {
                                    echo "$campoAValidar > $valorRegla";
                                    $this->addError($campo, "Debe ser menor que " . $valorRegla);
                                }
                            } else {
                                if (strlen($campoAValidar) > $valorRegla) {
                                    $this->addError($campo, "Debe ser menor que " . $valorRegla);
                                }
=======
                            if (strlen($campoAValidar) > $valorRegla) {
                                $this->addError($campo, "Debe ser menor que " . $valorRegla);
>>>>>>> 75d28b9739d6e9f2b803ed6a8287fcdfafa56765
                            }
                            break;

                        case 'value':
                            if (!($campoAValidar == $valorRegla)) {
                                $this->addError($campo, "Debe tener más de " . $valorRegla . " carácteres");
                            }
                            break;
                    }

                    /*if ($regla == "min") {
                        if (!($campoAValidar >= $valorRegla)) {
                            $this->addError($campo, "tiene que tener más de 8 carácteres");
                        }
                    }*/
<<<<<<< HEAD
                }
            } else {
                $this->addError($campo, "Es requerido");
=======

                }
            } else {
                $this->addError($campo, "requerido");
>>>>>>> 75d28b9739d6e9f2b803ed6a8287fcdfafa56765
            }
        }
    }

    public function addError($nombreCampo, $error)
    {
<<<<<<< HEAD
        //$this->errores[] = "El campo " . $nombreCampo . " : " . $error;
=======
>>>>>>> 75d28b9739d6e9f2b803ed6a8287fcdfafa56765
        $this->errores[] = "El campo " . $nombreCampo . " : " . $error;
    }

    public function getErrores()
    {
        return $this->errores;
<<<<<<< HEAD
    }

    public function getMensajeError($campo)
    {
        foreach ($this->errores as $campoError => $error) {
            if ($campoError == $campo) {
                echo $error;
            }
        }

        /*
        if (isset($this->errores[$campo])) {
            return $this->errores[$campo];
        }*/
=======
>>>>>>> 75d28b9739d6e9f2b803ed6a8287fcdfafa56765
    }

    public function esValido()
    {
        if (empty($this->errores)) {
            $this->valido = true;
        } else {
            $this->valido = false;
        }
        return $this->valido;
    }
}
