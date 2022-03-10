<?php
include "helper/Utilidades.php";
include "helper/Input.php";
include "header.php";

if (Input::siEnviado()) {
    $errores = $validador->getErrores();
    if (!empty($errores)) {
        echo "<div class='error'>";
        foreach ($errores as $campo => $mensaje) {
            echo "<p>".$validador->getMensajeError($campo)."</p>\n";
        }
        echo "</div>";
    }
}

?>
<form id="form" action="index.php" method="post" enctype="multipart/form-data">

    <div>
        <div class='uno'>
            <label>
                Usuario
                <input type="text" name="usuario" minlength="8" maxlength="12" value="agonzalgam1"
                <?php
                if (isset($_POST['usuario'])) {
                    echo "value=" . Input::filtrarDato('usuario');    
                }                               
                
                ?>
                >
            </label>
            <br>
            <label>Aula
                <select name='aula'>
                    <?php
                    $aulas = ["A01", "A02", "A03", "A04", "A05", "A06"];
                    foreach ($aulas as $aula) {
                        echo "<option id='aula' value=$aula ";
                        if (isset($_GET['aula_seleccionada']) && $_GET['aula_seleccionada'] == $aula) {
                            echo "selected >";
                        } else {
                            echo Utilidades::verificarSelect(Input::get('aula'), $aula) . ">";
                        }
                        
                        echo "$aula </option>";
                    }
                    ?>
                </select><br /></label>
            <div class="horario">
            <label for="fecha">
                    Fecha:
                    <input type="date" id="fecha" name="fecha"
                    <?php
                    if (isset($_GET['fecha_seleccionada'])) {
                        $fecha_seleccionada = $_GET['fecha_seleccionada'];
                        echo "value = $fecha_seleccionada";
                    }
                    $diaActual = "20" . date('y-m-d');
                    echo " min=$diaActual value='2022-02-25'>";
                    
                    ?>
                </label>
                <br />
                <div class="horas">
                <label>
                        Desde
                        <select name='hora-desde'>
                    <?php
                    $horas = ['08:30', '09:25', '10:20', '11:15', '11:45', '12:40', '13:35', '14:30', '15:25', '16:20', '17:15', '18:10', '19:05', '20:00', '21:00'];
                    foreach ($horas as $hora) {
                        echo "<option id='hora-desde' value=$hora name='hora-desde' ";
                        
                        if (isset($_GET['hora_seleccionada']) && $_GET['hora_seleccionada'] == $hora) {
                            $hora_seleccionada = $_GET['hora_seleccionada'];
                            echo "selected >";
                        } else {
                            echo Utilidades::verificarSelect(Input::get('hora-desde'), $hora) . " >";
                        }
                        echo "$hora </option>";
                    }
                    ?>
                </select><br />
                    </label>
                    <label>
                        Hasta
                        <select name='hora-hasta'>
                        <?php
                        $horas = ['08:30', '09:25', '10:20', '11:15', '11:45', '12:40', '13:35', '14:30', '15:25', '16:20', '17:15', '18:10', '19:05', '20:00', '21:00'];
                        foreach ($horas as $hora) {
                            echo "<option id='hora-hasta' value=$hora name='hora-hasta' ";
                            echo Utilidades::verificarSelect(Input::get('hora-hasta'), $hora) . " >";                      
                            echo "$hora </option>";
                        }
                        ?>
                    </select><br />
                    </label>
                </div>
            </div>
            <input id="submit" type="submit" name="enviar" 
            <?php
            echo "value=$fase />";
            ?>
</form>


<?php

if (isset($resultado)) {
    echo "<div class='resultado'/>";
    echo $resultado;
    echo "</div>";
}

include "footer.php"
?>
