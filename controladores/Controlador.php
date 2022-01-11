<?php
include "helper/ValidadorForm.php";
class Controlador
{
    //private $resultado = null;
    public function run()
    {
        if (!isset($_POST['enviar'])) // No se ha enviado el formulario
        {
            // Se llama al método para mostrar el formulario inicial pasando un argumento sin valor como resultado
            $this->mostrarFormulario("Validar", null, null);
            exit();
        } else {
            if ($_POST['enviar'] == "validar") {
                # code...
            }
            // Resultado es la variable que guarda toda la información del formulario
            $resultado = "<h3>Datos:</h3> <br>";

            // Error es la variable que muestra todos los errores del formulario
            //$error = null;

            // Campo de Usuario
            $usuario = $_POST['usuario'];
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
            "usuario" => array("required" => true, "min" => 8, "max" => 12),
            "clase" => array("required" => true, "value" => !null),
            "fecha" => array("required" => true, "min" => ("20" . date("y-m-d"))),
            "hora-desde" => array("required" => true, "min" => "8:30", "max" => "hora-hasta"),
            "hora-hasta" => array("required" => true, "min" => "hora-desde", "max" => "21:00")
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
            $this->mostrarFormulario("continuar", $validador, $resultado);
            exit();
        }

        //Formulario incorrecto, mostrarlo con los errores
        $this->mostrarFormulario("validar", $validador, null);
        exit();
    }
}
