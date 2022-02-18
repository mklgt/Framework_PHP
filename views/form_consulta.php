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
                    <input type="date" id="fecha_consulta" name="fecha_consulta">
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


if (isset($_POST['aula_consulta'])) {
    echo "<h1>Clase: $aula_consulta</h1>";
    echo "<h1>Día: $fecha_consulta</h1>";
    echo "<div class='calendario'/>";
    echo "<p class='libre'>8:30</p>";
    echo "<p class='libre'>9:25</p>";
    echo "<p class='ocupado'>10:20</p>";
    echo "<p class='ocupado'>11:15</p>";
    echo "<p class='libre'>11:45</p>";
    echo "<p class='ocupado'>12:40</p>";
    echo "<p class='ocupado'>13:35</p>";
    echo "<p class='libre'>14:30</p>";
    echo "<p class='libre'>15:25</p>";
    echo "<p class='ocupado'>16:20</p>";
    echo "<p class='libre'>17:15</p>";
    echo "<p class='ocupado'>18:10</p>";
    echo "<p class='libre'>19:05</p>";
    echo "<p class='ocupado'>20:00</p>";
    echo "<p class='libre'>21:00</p>";
    echo "</div>";
}


include "footer.php"
?>