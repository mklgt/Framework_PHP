<?php
include "helper/ValidadorForm.php";
include "modelo/DaoReserva.php";
include "modelo/Reserva.php";

class Controlador
{
    private $dao;

    public function run()
    {

        if (isset($_POST['pagina']) && ($_POST['pagina']) == 'consulta') {
            $this->mostrarConsulta();
            unset($_POST);
        } else {
            if (!isset($_POST['enviar'])) // No se ha enviado el formulario
            {
                // Se llama al método para mostrar el formulario inicial pasando un argumento sin valor como resultado
                $this->mostrarFormulario("Validar", null, null);
                exit();
            }
            if (isset($_POST['enviar']) && ($_POST['enviar']) == 'Validar') {

                $this->validar();
                exit();
            }
            if (isset($_POST['enviar']) && ($_POST['enviar']) == 'Continuar') {

                unset($_POST);
                $this->mostrarFormulario('Validar', null, null);
            }
        }
        
    }

    // Metodo que muestra el formulario
    private function mostrarFormulario($fase, $validador, $resultado)
    {
        //se muestra la vista del formulario (la plantilla form_bienvenida.php)   
        include 'views/form_bienvenida.php';
    }

    //Metodo que muestra la página de consultas
    private function mostrarConsulta()
    {
        //se muestra la vista del formulario (la plantilla form_consultas.php)   
        include 'views/form_consulta.php';
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

    private function validar()
    {
        $validador = new ValidadorForm();
        $reglasValidacion = $this->crearReglasDeValidacion();
        $validador->validar($_POST, $reglasValidacion);
        if ($validador->esValido()) {
            //Formulario correcto, recoge datos y los
            //vuelve a mostrar con el resultado correcto
            // Resultado es la variable que guarda toda la información del formulario

            $resultado = "<h3>Datos:</h3> <br>";

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

            $this->registrar($validador);
            if ($validador->esValido()) {
                $this->mostrarFormulario("Continuar", $validador, $resultado);
            } else {
                $this->mostrarFormulario("Validar", $validador, null);
            }

            exit();
        }

        //Formulario incorrecto, mostrarlo con los errores
        $this->mostrarFormulario("Validar", $validador, null);
        exit();
    }

    private function crearReserva($datos)
    {
        $usuario = $datos['usuario'];
        $aula = $datos['aula'];
        $fecha = $datos['fecha'];
        $horaInicio = $datos['hora-desde'];
        $horaHasta = $datos['hora-hasta'];
        $reserva = new Reserva($usuario, $aula, $fecha, $horaInicio, $horaHasta);
        return $reserva;
    }

    private function registrar($validador)
    {
        $this->dao = new DaoReserva();
        $reserva = $this->crearReserva($_POST);


        $existeReserva = $this->dao->existeReserva($reserva);
        if (!$existeReserva) {
            $this->dao->insertarReserva($reserva);
        } else {
            $validador->addError("Reservada", "Aula ya reservada");
        }
    }
}
