<?php
include "helper/Utilidades.php";
include "helper/Input.php";
include "header.php";
echo "<br>";
if (isset($error)) {
    echo "<div class='error'/>";
    echo $error;
    echo "</div>";
}

?>
<form id="form" action="index.php" method="post">

    <div>
        <div class='uno'>
            <label>
                Usuario
                <input type="text" name="usuario" />
            </label>
            <br />
            <label>Clase
                <select name="aula">
                    <!--<option value="null" disabled selected>-- Selecciona una opción --</option>-->
                    <?php
                    $aulas = ["A01", "A02", "A03", "A04", "A05", "A06"];
                    foreach ($aulas as $aula) {
                        echo "<option value=$aula ";
                        echo Utilidades::verificarSelect(Input::get('aula'), $aula) . ">";
                        echo "$aula </option>";
                    }
                    ?>
                </select><br /></label>
            <div class="horario">
                <label for="fecha">
                    Fecha:
                    <input type="date" id="fecha" name="fecha"
                    <?php
                    $diaActual = date('y-m-d');
                    echo "min=$diaActual>";

                    ?>
                </label>
                <br />
                <div class="horas">
                    <label>
                        Desde
                        <input id="hora-desde" type="time" name="hora-desde">
                    </label>
                    <label>
                        Hasta
                        <input id="hora-hasta" type="time" name="hora-hasta">
                    </label>
                </div>
            </div>
            <input id="submit" type="submit" name="enviar" value="Enviar" />
</form>


<?php
if (isset($resultado)) {
    echo "<div class='resultado'/>";
    echo $resultado;
    echo "</div>";
}

include "footer.php"
?>