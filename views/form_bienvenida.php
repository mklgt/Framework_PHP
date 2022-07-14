<?php
include "helper/Utilidades.php";
include "helper/Input.php";
include "header.php";

if (Input::siEnviado()) {
    $errores = $validador->getErrores();
    if (!empty($errores)) {
        echo "<div class='bg-danger w-75 p-3 mx-auto mt-3 fw-bold rounded'>";
        foreach ($errores as $campo => $mensaje) {
            echo "<p>" . $validador->getMensajeError($campo) . "</p>\n";
        }
        echo "</div>";
    }
}

?>
<form id="form" action="index.php" method="post" enctype="multipart/form-data">

    <div>
        <div class='bg-secundario mt-4 rounded w-75 mx-auto p-3 fs-6 mb-5'>
            <label class="w-100 mt-2">
                Usuario
                <input class="w-100 rounded border-0 p-1 mt-1" type="text" name="usuario" minlength="8" maxlength="12" <?php
                if (isset($_SESSION['usuario'])) {
                    echo "value= " . $_SESSION['usuario'];
                }
                ?>>
            </label>
            <br>
            <label class="w-100 mt-3">Aula
                <input list="aula" name='aula' class="w-100 rounded border-0 p-1 mt-1" autocomplete="off"
                <?php
                    if (isset($_SESSION['aula'])) {
                        echo Utilidades::verificarValorCampo(Input::get('aula'), $_SESSION['aula']);
                    }
                    if (isset($_GET['aula_seleccionada'])) {
                        $aula_seleccionada = $_GET['aula_seleccionada'];
                        echo " value = $aula_seleccionada ";
                    }
                ?>
                >
                <datalist id="aula">
                    <?php
                    foreach ($aulas as $aula) {
                        echo "<option id='aula' value=$aula>";
                        echo "$aula </option>";
                    }
                    ?>
                </datalist>
                <br /></label>
            <div class="bg-principal mt-2 p-3 rounded">
                <label for="fecha">
                    Fecha:
                    <input class="rounded border-0 p-1 mt-1" type="date" id="fecha" name="fecha"
                    <?php
                        if (isset($_SESSION['fecha'])) {
                            echo Utilidades::verificarValorCampo(Input::get('fecha'), $_SESSION['fecha']);
                        }
                        if (isset($_GET['fecha_seleccionada'])) {
                            $fecha_seleccionada = $_GET['fecha_seleccionada'];
                            echo "value = $fecha_seleccionada";
                        }
                        $diaActual = "20" . date('y-m-d');
                        echo " min=$diaActual value=$diaActual>";
                    
                    ?>
                </label>
                <br />
                <div class="mt-3">
                <label>
                        Desde
                        <select id="hora-inicial" class="mx-2 rounded border-0 p-1" name='hora-desde'>
                    <?php
                    $horaActual = date('H:i');
                    $diaActual = date("Y-m-d");

                    foreach ($horas as $hora) {
                        echo "<option id='hora-desde' value=$hora name='hora-desde' ";
                        if (isset($_GET['hora_seleccionada']) && $_GET['hora_seleccionada'] == $hora) {
                            $hora_seleccionada = $_GET['hora_seleccionada'];
                            echo "selected ";
                        } else {
                            if (isset($_SESSION['hora-desde']) && $hora == $_SESSION['hora-desde']) {
                                echo "selected ";
                            }
                        }
                        
                        echo "> $hora </option>";
                    }
                    ?>
                </select><br />
                    </label>
                    <label>
                        Hasta
                        <select id="hora-final" class="mx-2 rounded border-0 p-1" name='hora-hasta'>
                        <?php
                        foreach ($horas as $hora) {
                            echo "<option id='hora-hasta' value=$hora name='hora-hasta' ";
                            if (isset($_GET['hora_seleccionada']) && $_GET['hora_seleccionada'] == $hora) {
                                $hora_seleccionada = $_GET['hora_seleccionada'];
                                echo "selected ";
                            } else {
                                if (isset($_SESSION['hora-hasta']) && $hora == $_SESSION['hora-hasta']) {
                                    echo "selected ";
                                } 
                            }                    
                            echo "> $hora </option>";
                        }
                        ?>
                    </select><br />
                    </label>
                </div>
                
            </div>
            <br>
            <label class="w-100">
                Motivo:
                <br>
                <textarea id="motivo" class="w-100 rounded border-0 p-1 mt-1" name="motivo" rows="7" cols="100" placeholder="Esciba el motivo de su reserva..." required><?php if (isset($_SESSION['motivo'])) { echo Input::filtrarDato('motivo');}?></textarea>
            </label>
            <input id="submit" class="btn btn-success w-100 p-2 mt-3" type="submit" name="enviar" 
            <?php
            echo "value=$fase />";
            ?>
</form>
<?php

if (isset($resultado)) {
    echo $resultado;
}

include "footer.php"
?>