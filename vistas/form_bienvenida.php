<?php
include "cabecera.php";
?>
<form id="form" action="index.php" method="post">

    <div>
        <div class='uno'>
            <label>Nombre</label>
            <input type="text" name="nombre" /><br />
            <label>Apellido</label>
            <input type="text" name="apellido" /><br />
            <div>
                <div class='uno'>
                    <label>Ciclo</label><br />
                    <input type="radio" name="ciclo" value="DAW" />DAW<br />
                    <input type="radio" name="ciclo" value="DAM" />DAM<br />
                    <input type="radio" name="ciclo" value="ASIR" />ASIR<br />
                    <label>&nbsp;</label>
                    <input type="submit" name="enviar" value="Enviar" />
                </div>
            </div>
</form>
<?php
include "pie.php";
?>