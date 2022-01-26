<?php
include "helper/ValidadorForm.php";

class Controlador
{

    private $dao;

    //private $resultado = null;
    public function run()
    {
        if (!isset($_POST['enviar'])) // No se ha enviado el formulario
        {
            // Se llama al método para mostrar el formulario inicial pasando un argumento sin valor como resultado
            $this->mostrarFormulario("Validar", null, null);
            exit();
        } else {
            // if ($_POST['enviar'] == "validar") {
            //     # code...
            // }
            // Resultado es la variable que guarda toda la información del formulario
            $resultado = "<h3>Datos:</h3> <br>";

            // Campo de Usuario
            if (str_contains($_POST['usuario'], "<") && str_contains($_POST['usuario'], ">")) {
                $usuario = strip_tags($_POST['usuario']);
            } else if (str_contains($_POST['usuario'], "<")) {
                $usuario = str_replace("<", "", $_POST['usuario']);
            } else if (str_contains($_POST['usuario'], ">")) {
                $usuario = str_replace(">", "", $_POST['usuario']);
            } else {
                $usuario = $_POST['usuario'];
            }

            //$usuario = htmlspecialchars($_POST['usuario'], ENT_QUOTES);
            $resultado .= "·Usuario: $usuario <br>";

            // Campo de Aula
            $aula = $_POST['aula'];
            $resultado .= "·Aula: " . strtoupper($aula) . " <br />";

            // Campo de Fecha
            $fecha = $_POST['fecha'];
            $resultado .= "·Fecha: $fecha <br>";

            // Campo de Hora de Inicio
            $horaInicio = $_POST['hora-desde'];
            $resultado .= "·Desde: $horaInicio ";

            // Campo de Hora Fin
            $horaFin = $_POST['hora-hasta'];
            $resultado .= "hasta: $horaFin";

            $resultado .= "<br />";

            // Se llama al metodo de mostrar pasando el Resultado como argumento para mostrar
            $this->validar($resultado);
            exit();
        }
    }

    // Metodo que muestra el formulario
    private function mostrarFormulario($fase, $validador, $resultado)
    {
        //se muestra la vista del formulario (la plantilla form_bienvenida.php)   
        include 'views/form_bienvenida.php';
    }

    private function crearReglasDeValidacion()
    {

        $reglasValidacion = array(
            "usuario" => array("min" => 8, "max" => 12, "numeric" => false, "required" => true),
            "aula" => array("value" => !null, "required" => true),
            "fecha" => array("min" => (date("Y-m-d")), "required" => true),
            "hora-desde" => array("min" => "8:30", "max" => $_POST['hora-hasta'], "required" => true),
            "hora-hasta" => array("min" => $_POST['hora-desde'], "max" => "21:00", "required" => true)
        );
        return $reglasValidacion;
    }

    private function validar($resultado)
    {
        $validador = new ValidadorForm();
        $reglasValidacion = $this->crearReglasDeValidacion();
        $validador->validar($_POST, $reglasValidacion);
        if ($validador->esValido()) {
            //Formulario correcto, recoge datos y los
            //vuelve a mostrar con el resultado correcto
            $this->mostrarFormulario("Continuar", $validador, $resultado);
            exit();
        }

        //Formulario incorrecto, mostrarlo con los errores
        $this->mostrarFormulario("Validar", $validador, null);
        exit();
    }
}
