<?php
include "cabecera.php";
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
                <select name="clase">
                    <option value="a01">A01</option>
                    <option value="a02">A02</option>
                    <option value="a03">A03</option>
                    <option value="a04">A04</option>
                    <option value="a05">A05</option>
                    <option value="a06">A06</option>
                </select><br /></label>
            <div class="horario">
                <label for="fecha">
                    Fecha:
                    <input type="date" id="fecha" name="fecha">
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
            <input type="submit" name="enviar" value="Enviar" />
</form>


<?php
if (isset($resultado)) {
    echo "";
    include "pie.php";
}

?>