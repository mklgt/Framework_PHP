<?php
class Controlador
{
    public function run()
    {
        if (!isset($_POST['enviar']))//no se ha enviado el formulario
        { // primera petición
            //se llama al método para mostrar el formulario inicial
            $this->mostrarFormulario();
			exit();
        } else
        {
            $resultado ="Bienvenido/a ";
            //el formulario ya se ha enviado
            //se recogen y procesan los datos
            //se llama al método para mostrar el resultado
            if (!empty($nombre=$_POST['nombre'])){
            $nombre=$_POST['nombre'];
            $resultado .= " $nombre ";
            }
            if (!empty($nombre=$_POST['apellido'])){
            $apellido=$_POST['apellido'];
            $resultado .= " $apellido <br />";
            }
            if (isset($_POST['ciclo'])) {
                $ciclo = $_POST['ciclo'];
                $resultado .= "Del ciclo: ";
                switch ($ciclo) {
                    case "DAW":
                        $resultado .= "DAW ";
                        break;
                    case "DAM":
                        $resultado .= "DAM";
                        break;
                    case "ASIR":
                        $resultado .= "ASIR";
                        break;
                }
            }
            $resultado .= "<br />";
            $this->mostrarResultado($resultado);
			exit();		
        }
    }
    private function mostrarFormulario()
    {
     //se muestra la vista del formulario (la plantilla form_bienvenida.php)   
        include 'vistas/form_bienvenida.php';
    }
    private function mostrarResultado($resultado)
    {
    // y se muestra la vista del resultado (la plantilla resultado.,php)
        include 'vistas/vista_resultado.php';
    }
}
