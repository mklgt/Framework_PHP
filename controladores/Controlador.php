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

            // Campo de Usuario
            $usuario = $_POST['usuario'];
            $resultado .= "·Usuario: $usuario <br>";

            // Campo de Aula
            $clase = $_POST['clase'];
            $resultado .= "·Clase: " . strtoupper($clase) . " <br />";

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
}
