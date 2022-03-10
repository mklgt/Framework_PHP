<?php
include "helper/Utilidades.php";
include "helper/Input.php";
include "header.php";
?>


<form id="formConsulta" action="index.php" method="post">
    <div>
        <div class='uno'>
            <div class="horario">
                <label for="fecha">
                    Fecha:
                    <input type="date" id="fecha_consulta" name="fecha_consulta" value="2022-03-31">
                </label>
                <br />
                <div class="horas">
                    <label for="fecha">
                        Clase:
                        <select name='aula_consulta'>
                            <?php
                            $aulas = ["A01", "A02", "A03", "A04", "A05", "A06"];
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
        <input id="submit" type="submit" name="consulta" value="Consultar" />

    </div>

</form>

<?php

if (isset($_POST['aula_consulta']) && isset($_POST['fecha_consulta'])) {
    $aula_consulta = $_POST['aula_consulta'];
    $fecha_consulta = $_POST['fecha_consulta'];
}
echo "<pre>";
print_r($datosTotales);
echo "</pre>";


if (isset($_POST['aula_consulta'])) {
    echo "<h1>Clase: $aula_consulta</h1>";
    echo "<h1>Día: $fecha_consulta</h1>";
    $horas = ['08:30', '09:25', '10:20', '11:15', '11:45', '12:40', '13:35', '14:30', '15:25', '16:20', '17:15', '18:10', '19:05', '20:00', '21:00'];

    echo "<div class='calendario'/>";
    foreach ($horas as $hora) {
        foreach ($datosTotales as $datos) {
        $usuario = $datos['usuario'];
        $horasOcupadas = $datos['horasOcupadas'];

        if (in_array($hora, $horasOcupadas)) {
            $clase = 'ocupado';      
        } else {
            $clase = 'libre';
        }
    }
        echo "<p class='$clase'><a href='index.php?hora_seleccionada=$hora&&fecha_seleccionada=$fecha_consulta&&aula_seleccionada=$aula_consulta'>$hora</a></p>";
    }
    echo "</div>";
}

include "footer.php"
?>