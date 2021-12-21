<?php
class Controlador
{

    public function run()
    {
        if (!isset($_POST['enviar'])) // No se ha enviado el formulario
        {
            // Se llama al método para mostrar el formulario inicial pasando un argumento sin valor como resultado
            $this->mostrarFormulario(null);
            exit();
        } else {
            // Resultado es la variable que guarda toda la información del formulario
            $resultado = "<h3>Datos:</h3> <br>";

            // Error es la variable que muestra todos los errores del formulario
            $error = null;

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
            $this->mostrarFormulario($resultado);
            exit();
        }
    }

    // Metodo que muestra el formulario
    private function mostrarFormulario($resultado)
    {
        //se muestra la vista del formulario (la plantilla form_bienvenida.php)   
        include 'views/form_bienvenida.php';
    }

    private function crearReglasDeValidacion()
    {

        //TODO: MODIFICAR ESTAS LINEAS
        $reglasValidacion = array(
            "usuario" => array("required" => true),
            "clase" => array("required" => true),
            "fecha" => array("required" => true, "min" => date("d M Y")),
            "hora-desde" => array("required" => true, "min" => date("d M Y")),
            "hora-hasta" => array("required" => true, "min" => array("hora-desde", "8:30"), "max" => "21:00")
        );
    }
}
