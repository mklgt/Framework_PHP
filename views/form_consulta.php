<?php
include "helper/Utilidades.php";
include "helper/Input.php";
include "header.php";
?>


<form id="formConsulta" action="index.php" method="post">
    <div class='bg-secundario mt-4 rounded w-75 mx-auto p-3 fs-6 mb-5'>
        <div class="bg-principal p-3 rounded">
            <div class="horario">
                <label for="fecha_consulta">
                    Fecha:
                    <input type="date" class="w-100 rounded border-0 p-1 mt-1" id="fecha_consulta" name="fecha_consulta"
                    <?php
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
                    <label for="fecha">
                        Clase:
                        <select name='aula_consulta' class="w-100 rounded border-0 p-1 mt-1">
                            <?php
                            foreach ($aulas as $aula) {
                                echo "<option id='aula' value=$aula ";
                                echo Utilidades::verificarSelect(Input::get('aula_consulta'), $aula) . ">";
                                echo "$aula </option>";
                            }
                            ?>
                        </select>
                    </label>
                </div>
            </div>
        </div>
        <input id="submit" class="btn btn-secondary w-100 p-2 mt-3" type="submit" name="consulta" value="Consultar" />

    </div>

</form>

<?php

if (isset($_POST['aula_consulta']) && isset($_POST['fecha_consulta'])) {
    $aula_consulta = $_POST['aula_consulta'];
    $fecha_consulta = $_POST['fecha_consulta'];
}


if (isset($_POST['aula_consulta'])) {
    setlocale(LC_TIME, "spanish");
    $mi_fecha = $fecha_consulta;
    $mi_fecha = str_replace("/", "-", $mi_fecha);			
    $fecha_consultada = date("d-m-Y", strtotime($mi_fecha));
    echo "<h1 class='text-center'>Clase: $aula_consulta</h1>";
    echo "<h1 class='text-center'>Día: $fecha_consultada</h1>";

    echo "<div class='bg-grisClaro w-75 mx-auto p-3 mb-3 rounded border border-dark border-2'/>";
    foreach ($horas as $hora) {
        $ocupada = false;
        $clase = 'libre';
        foreach ($datosTotales as $datos) {
            $usuario = $datos['usuario'];
            $horasOcupadas = $datos['horasOcupadas'];
            if (in_array($hora, $horasOcupadas)) {
                $clase = 'ocupado';    
                echo "<p class='$clase p-1 rounded fw-bold' id='clase-ocupada'><a>$hora - Reservada por: $usuario</a></p>";
                $ocupada = true;
            } else {
                $clase = 'libre';
            }
        }
        if (!$ocupada) {
            echo "<p class='$clase p-1 rounded fw-bold'><a class='text-decoration-none text-black pr-75' href='index.php?hora_seleccionada=$hora&&fecha_seleccionada=$fecha_consulta&&aula_seleccionada=$aula_consulta'>$hora - Disponible</a></p>";
        }
        
    }
    echo "</div>";
}

include "footer.php"
?>