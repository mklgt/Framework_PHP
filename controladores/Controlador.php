<?php
include "helper/ValidadorForm.php";
include "modelo/DaoReserva.php";
include "modelo/DaoSession.php";
include "modelo/DaoXML.php";
include "modelo/Reserva.php";

//Código para el envio del correo electrónico
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/Exception.php';
require './PHPMailer/PHPMailer.php';
require './PHPMailer/SMTP.php';

class Controlador
{
    private $dao;

    public function run()
    {
        header('Cache-Control: no cache');
        session_cache_limiter('private_no_expire');
        session_start();

        // Aquí Mejor donde interese
        //$aulas = $this->mostrarAulas();
        //$horas = $this->mostrarHoras();
        
        // Aulas Ocupadas extraidas del XML
        if (isset($_POST['pagina']) && ($_POST['pagina']) == 'Ocupadas') {
            $this->mostrarbbddOcupadas(null);
            exit();
        }
        if (isset($_POST['bbdd']) && ($_POST['bbdd']) == 'Insertar aulas ocupadas') {
            $resultado = "";

            $this->dao = new DaoXML();
            $this->dao->dropTables("aulasOcupadas");
            $this->dao->createTables();

            $this->dao->insertarXML('ocupadas');
            $resultado = "Archivo subido";
            $this->mostrarbbddOcupadas($resultado);
            exit();
        }

        // CREAR LAS TABLAS TRAMO Y AULA
        if (isset($_POST['pagina']) && ($_POST['pagina']) == 'bbdd') {
            $this->mostrarbbdd(null);
            exit();
        }
        if (isset($_POST['bbdd']) && ($_POST['bbdd']) == 'Actualizar') {
            $resultado = "";

            $this->dao = new DaoXML();
            $this->dao->dropTables("datosForm");
            $this->dao->createTables();

            $this->dao->insertarXML('actualizar');
            $resultado = "Archivo subido";
            $this->mostrarbbdd($resultado);
            exit();
        }

        // INSERTAR USUARIOS
        if (isset($_POST['csvUsers']) && ($_POST['csvUsers']) == 'Subir usuarios') {
            $this->dao = new DaoXML();
            $this->dao->dropTables("datosUser");
            $this->dao->insertarCSV();
            $this->mostrarbbddOcupadas(null);
            exit();
        }

        if ((isset($_POST['pagina']) && ($_POST['pagina']) == 'editar') || (isset($_POST['eliminar']) && $_POST['eliminar'] == 'Eliminar')) {
            if (isset($_POST['eliminar']) && $_POST['eliminar'] == 'Eliminar') {
                $this->eliminarReserva($_POST['idReserva']);
                $_POST['eliminar'] = "";
            }
            $reservasUsuario = $this->mostrarReservasRealizadas($_SESSION['usuario']);
            $this->mostrarEditarReservas($reservasUsuario);
            exit();
        }

        if ((isset($_POST['pagina']) && ($_POST['pagina']) == 'todasReservas') || (isset($_POST['eliminarJE']) && $_POST['eliminarJE'] == 'Eliminar')) {
            if (isset($_POST['eliminarJE']) && $_POST['eliminarJE'] == 'Eliminar') {
                $this->eliminarReserva($_POST['idReserva']);
                $_POST['eliminarJE'] = "";
            }
            $reservasUsuario = $this->mostrarReservasRealizadas("*");
            $this->mostrarTodasReservas($reservasUsuario);
            exit();
        }



        if ((isset($_POST['pagina']) && ($_POST['pagina']) == 'consulta') || (isset($_POST['consulta']) && $_POST['consulta'] == 'Consultar')) {

            if (isset($_POST['fecha_consulta']) && isset($_POST['aula_consulta'])) {
                $datosTotales = $this->consultarFecha($_POST['fecha_consulta'], $_POST['aula_consulta']);
                $aulasOcupadas = $this->consultarOcupadasPorFecha($_POST['fecha_consulta'], $_POST['aula_consulta']);
            } else {
                $datosTotales = '';
                $aulasOcupadas = '';
            }
            $aulas = $this->mostrarAulas();
            $horas = $this->mostrarHoras();
            $this->mostrarConsulta($aulas, $horas, $datosTotales, $aulasOcupadas);
            exit();
        } else {
            //session_start();
            if (empty($_SESSION['contraseña']) || empty($_SESSION['usuario'])) {
                $this->mostrarLogin("");
                exit();
            } else {
                $usuario = $_SESSION['usuario'];
                $contraseña = $_SESSION['contraseña'];
                if (!$this->comprobarDatosSesion($usuario, $contraseña)) {
                    $this->mostrarLogin("Usuario y/o contraseña incorrectos");
                    exit();
                }
            }
        }


        /*  $aulas = $this->mostrarAulas();
            $horas = $this->mostrarHoras(); */

        if (!isset($_POST['enviar'])) // No se ha enviado el formulario
        {
            $aulas = $this->mostrarAulas();
            $horas = $this->mostrarHoras();
            // Se llama al método para mostrar el formulario inicial pasando un argumento sin valor como resultado
            $this->mostrarFormulario($aulas, $horas, "Reservar", null, null);
            exit();
        }
        if (isset($_POST['enviar']) && ($_POST['enviar']) == 'Reservar') {

            $this->validar();
            exit();
        }
        if (isset($_POST['enviar']) && ($_POST['enviar']) == 'Continuar') {
            $aulas = $this->mostrarAulas();
            $horas = $this->mostrarHoras();
            $mensaje = '<div class="bg-success border-grisClaro mt-3 p-2 rounded text-center text-light fw-bold"><p class="h3">Reserva realizada</p></div>';
            unset($_POST);
            $this->mostrarFormulario($aulas, $horas, 'Reservar', null, $mensaje);
        }
    }


    // Metodo que muestra la pantalla de login
    public function mostrarLogin($errorLogin)
    {
        //se muestra la vista del formulario (la plantilla login.php)   
        include 'views/login.php';
    }

    // Metodo que muestra el formulario
    public function mostrarFormulario($aulas, $horas, $fase, $validador, $resultado)
    {
        //se muestra la vista del formulario (la plantilla form_bienvenida.php)
        include 'views/form_bienvenida.php';
    }

    //Metodo que muestra la página de consultas
    private function mostrarConsulta($aulas, $horas, $datosTotales, $aulasOcupadas)
    {
        //se muestra la vista del formulario (la plantilla form_consultas.php)
        include 'views/form_consulta.php';
    }

    //Metodo que muestra la página de edición de reservas
    private function mostrarEditarReservas($reservasUsuario)
    {
        //se muestra la vista plantilla editar_reservas.php 
        include 'views/editar_reservas.php';
    }

    //Metodo que muestra la página con todas las reservas de usuarios
    private function mostrarTodasReservas($reservasUsuario)
    {
        include 'views/todas_reservas.php';
    }

    //Metodo que muestra la página pra insertar XML
    private function mostrarbbdd($resultado)
    {
        include 'views/form_bbdd.php';
    }

    //Metodo que muestra la página pra insertar XML ocupadas
    private function mostrarbbddOcupadas($resultado)
    {
        include 'views/form_bbdd_ocupadas.php';
    }

    private function comprobarDatosSesion($usuario, $contraseña)
    {
        $this->dao = new DaoSession();
        $consulta = $this->dao->comprobarSesion($usuario, $contraseña);
        return $consulta;
    }

    private function mostrarAulas()
    {
        $this->dao = new DaoReserva();
        $consulta = $this->dao->consultarAulas();
        $todasAulas = [];
        foreach ($consulta as $aulas => $aula) {
            foreach ($aula as $valor) {
                if (!in_array($valor, $todasAulas)) {
                    $todasAulas[] = $valor;
                }
            }
        }
        return $todasAulas;
    }

    private function mostrarHoras()
    {
        $this->dao = new DaoReserva();
        $consulta = $this->dao->consultarHoras();
        $todasHoras = [];
        foreach ($consulta as $horas => $hora) {
            foreach ($hora as $valor) {
                $valor = substr($valor, 0, -3);
                if (!in_array($valor, $todasHoras)) {
                    $todasHoras[] = $valor;
                }
            }
        }
        asort($todasHoras);
        return $todasHoras;
    }

    private function mostrarReservasRealizadas($usuario)
    {
        $this->dao = new DaoReserva();
        $consulta = $this->dao->mostrarReservas($usuario);
        return $consulta;
    }

    private function eliminarReserva($id)
    {
        $this->dao = new DaoReserva();
        $this->dao->eliminarReserva($id);
    }


    private function crearReglasDeValidacion()
    {
        $aulas = $this->mostrarAulas();
        $reglasValidacion = array(
            "usuario" => array("min" => 8, "max" => 12, "numeric" => false, "required" => true),
            "aula" => array("value" => !null, "valido" => $aulas, "required" => true),
            "fecha" => array("min" => (date("Y-m-d")), "required" => true),
            "hora-desde" => array("min" => "08:10", "max" => $_POST['hora-hasta'], "igual" => $_POST['hora-hasta'], "required" => true),
            "hora-hasta" => array("min" => $_POST['hora-desde'], "max" => "19:40", "required" => true),
            "motivo" => array("required" => true),
        );
        return $reglasValidacion;
    }

    private function validar()
    {
        $_SESSION['aula'] = $_POST['aula'];
        $_SESSION['fecha'] = $_POST['fecha'];
        $_SESSION['hora-desde'] = $_POST['hora-desde'];
        $_SESSION['hora-hasta'] = $_POST['hora-hasta'];
        $_SESSION['motivo'] = $_POST['motivo'];

        $aulas = $this->mostrarAulas();
        $horas = $this->mostrarHoras();
        $validador = new ValidadorForm();
        $reglasValidacion = $this->crearReglasDeValidacion();

        $validador->validar($_POST, $reglasValidacion);
        if ($validador->esValido()) {
            //Formulario correcto, recoge datos y los
            //vuelve a mostrar con el resultado correcto
            // Resultado es la variable que guarda toda la información del formulario

            $resultado = "<div class='border-grisClaro mt-3 p-2 rounded'/><h3>Datos de reserva:</h3> <br>";

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
            $resultado .= "hasta: $horaFin <br>";

            // Campo de Hora Fin
            $motivo = $_POST['motivo'];
            $resultado .= "·Motivo: $motivo";

            $resultado .= "<br /></div>";

            $this->registrar($validador);
            if ($validador->esValido()) {
                $this->enviarCorreo($_POST);
                $this->mostrarFormulario($aulas, $horas, "Continuar", $validador, $resultado);
            } else {
                $this->mostrarFormulario($aulas, $horas, "Reservar", $validador, null);
            }
            $_SESSION['aula'] = "";
            $_SESSION['fecha'] = "";
            $_SESSION['hora-desde'] = "";
            $_SESSION['hora-hasta'] = "";
            $_SESSION['motivo'] = "";
            exit();
        }

        //Formulario incorrecto, mostrarlo con los errores
        $this->mostrarFormulario($aulas, $horas, "Reservar", $validador, null);
        exit();
    }

    private function crearReserva($datos)
    {
        $usuario = $datos['usuario'];
        $aula = $datos['aula'];
        $fecha = $datos['fecha'];
        $horaInicio = $datos['hora-desde'];
        $horaHasta = $datos['hora-hasta'];
        $motivo = $datos['motivo'];
        $reserva = new Reserva($usuario, $aula, $fecha, $horaInicio, $horaHasta, $motivo);
        return $reserva;
    }

    private function registrar($validador)
    {
        $this->dao = new DaoReserva();
        $reserva = $this->crearReserva($_POST);
        $existeReserva = $this->dao->existeReserva($reserva);
        $existeOcupada = $this->dao->existeOcupada($reserva);

        if (!$existeReserva && !$existeOcupada) {
            $this->dao->insertarReserva($reserva);
        } else {
            if ($existeReserva) {
                $validador->addError("Reservada", "Aula reservada");
            } else if ($existeOcupada){
                $validador->addError("Reservada", "Aula ocupada permanente");
            }
            
        }
    }

    private function consultarFecha($fecha, $aula)
    {
        $this->dao = new DaoReserva();
        $consulta = $this->dao->consultarFechaAula($fecha, $aula);

        return $consulta;
    }

    private function consultarOcupadasPorFecha($fecha, $aula)
    {
        $this->dao = new DaoReserva();
        $consulta = $this->dao->consultarAulasOcupadas($fecha, $aula);

        return $consulta;
    }

    private function enviarCorreo($datos)
    {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            //TODO ocultar email y contraseña
            $mail->Username   = '****';
            $mail->Password   = '****';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;

            // Correo desd donde se envía el mensaje
            $mail->setFrom('agonzalgam1@educacion.navarra.es', 'Reserva de aulas');

            // Correo al que llegará el mensaje
            //$mail->addAddress($datos['usuario'] . '@educacion.navarra.es', 'Usuario');             
            $mail->addAddress('agonzalgam1@educacion.navarra.es', 'Usuario');

            // Correo donde llega una copia del mensaje
            //$mail->addCC('jefeestudios@mariaanasanz.es'); Copia a Jefatura de estudios
            $mail->addCC('agonzalgam1@educacion.navarra.es');


            //Contenido del mensaje
            $mail->isHTML(true);
            $mail->Subject = 'Reserva del aula ' . $datos['aula'];
            $mail->Body    = '
            <div style="background-color: #C9D6DF; width: 75%; margin: auto; font-family: Poppins; border-radius: 5px; padding: 10px; font-size: 22px;">
                <h1 style="text-align: center; margin: auto;">Reserva</h1>
                <hr style="background-color: black; height: 1px; border: none;">
                <p>Usted (' . $datos['usuario'] . ') ha reservado:</p>
                <ul>
                    <li>Aula: ' . $datos['aula'] . '</li>
                    <li>Fecha: ' . $datos['fecha'] . '</li>
                    <li>Desde las: ' . $datos['hora-desde'] . '</li>
                    <li>Hasta las: ' . $datos['hora-hasta'] . '</li>
                    <li>Motivo: ' . $datos['motivo'] . '</li>
                </ul>
            </div>
            ';
            //$mail->AltBody = 'Para clientes sin HTML (linux)';

            $mail->send();
            //echo 'El mensaje se envió correctamente';
        } catch (Exception $e) {
            echo "Error al enviar el correo al usuario, no se puedo realizar el envío";
        }
    }
}
