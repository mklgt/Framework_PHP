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
                        echo Utilidades::verificarSelect(Input::get('aula'), $aula) . ">";
                        echo "$aula </option>";
                    }
                    ?>
                </select><br /></label>
            <div class="horario">
                <label for="fecha">
                    Fecha:
                    <input type="date" id="fecha" name="fecha" value="2022-02-20"
                    <?php
                    $diaActual = "20" . date('y-m-d');
                    echo "min=$diaActual>";
                    
                    ?>
                </label>
                <br />
                <div class="horas">
                    <label>
                        Desde
                        <input id="hora-desde" type="time" name="hora-desde" min="08:30" max="21:00" value="09:00">
                    </label>
                    <label>
                        Hasta
                        <input id="hora-hasta" type="time" name="hora-hasta" min="08:30" max="21:00" value="10:20">
                    </label>
                </div>
            </div>
            <br>
            <label>
                Importar nuevo fichero:
                <input type="file" name="importar-archivo" accept="text/xml"> 
            </label> 
            <input id="submit" type="submit" name="enviar" 
            <?php
            echo "value=$fase />";
            ?>
</form>


<?php
echo $_POST['aula_consulta'];
if (isset($resultado)) {
    echo "<div class='resultado'/>";
    echo $resultado;
    echo "</div>";
}

include "footer.php"
?>
