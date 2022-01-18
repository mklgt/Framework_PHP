<?php
//include "Input.php";
/**
 * @method string validar($fuente, $reglasValidación)
 * @method string addError($nombreCampo, $error)
 * @method string esValido()
 * @method string getErrores()
 * @method string getMensajeError($campo)
 */
class ValidadorForm
{

    private $errores = [];
    //private $reglasValidacion = null;
    private $valido = false;

    public function __construct()
    {
    }

    /**
     * Comprueba que los campos cumplen las reglas de validación
     * @param  array $fuente
     * @param  array $reglasValidacion
     */
    public function validar($fuente, $reglasValidacion)
    {

        foreach ($reglasValidacion as $campo => $valores) {
            if (isset($fuente[$campo])) {
                $campoAValidar = $fuente[$campo];
                foreach ($valores as $regla => $valorRegla) {

                    switch ($regla) {
                        case 'required':

                            if (is_null($campoAValidar) || empty($campoAValidar)) {
                                $this->addError($campo, "Es requerido");
                            }
                            break;

                        case 'min':
                            if (strtotime($campoAValidar)) {
                                if (strtotime($campoAValidar) < strtotime($valorRegla)) {
                                    $this->addError($campo, "Debe ser mayor que " . $valorRegla);
                                }
                            } else {
                                if (strlen($campoAValidar) < $valorRegla) {
                                    $this->addError($campo, "Debe ser mayor que " . $valorRegla);
                                }
                            }
                            break;

                        case 'max':
                            if (strtotime($campoAValidar)) {
                                if (strtotime($campoAValidar) > strtotime($valorRegla)) {
                                    $this->addError($campo, "Debe ser menor que " . $valorRegla);
                                }
                            } else {
                                if (strlen($campoAValidar) > $valorRegla) {
                                    $this->addError($campo, "Debe ser menor que " . $valorRegla);
                                }
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
                }
            } else {
                $this->addError($campo, "Es requerido");
            }
        }
    }

    /**
     * Añade $error al array $errores en la clave asignada $campo
     * @param string $nombreCampo
     * @param string $error
     */
    public function addError($nombreCampo, $error)
    {
        $this->errores[$nombreCampo] = $error;
    }

    /**
     * Devuelve el array $errores
     * @return array $errores
     */
    public function getErrores()
    {
        return $this->errores;
    }

    /**
     * Devuelve el valor asociado a $campo
     * @param  string $campo
     * @return string
     */
    public function getMensajeError($campo)
    {
        foreach ($this->errores as $campoError => $mensaje) {
            if ($campoError == $campo) {
                echo "El campo " . $campo . " : " . $mensaje;
            }
        }
    }

    /**
     * Devuelve el valor de $valido
     * @return boolean $valido
     */
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
