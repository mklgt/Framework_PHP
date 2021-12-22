<?php
include "helper/Utilidades.php";
include "helper/Input.php";
include "header.php";
echo "<br>";

if (Input::siEnviado()) {
    $errores = $validador->getErrores();
    if (!empty($errores)) {
        echo "<div class='error'>";
        echo "</div>";
    }
} else {
    echo "<div class='error'/>";
    echo "No hay errores";
    echo "</div>";
}

?>
<form id="form" action="index.php" method="post">

    <div>
        <div class='uno'>
            <label>
                Usuario
                <input type="text" name="usuario" minlength="8" maxlength="12"
                <?php
                if (isset($_POST['usuario'])) {
                    echo "value=".$_POST['usuario'];    
                }                
                ?>
                />
            </label>
            <br />
            <label>Clase
                <select name="aula">
                    <option value="null" disabled selected>-- Selecciona una opción --</option>
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
                    $diaActual = "20" . date('y-m-d');
                    echo "min=$diaActual>";

                    ?>
                </label>
                <br />
                <div class="horas">
                    <label>
                        Desde
                        <input id="hora-desde" type="time" name="hora-desde" min="08:30" max="21:00">
                    </label>
                    <label>
                        Hasta
                        <input id="hora-hasta" type="time" name="hora-hasta" min="08:30" max="21:00">
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