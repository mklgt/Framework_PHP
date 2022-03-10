<?php
include "helper/Utilidades.php";
include "helper/Input.php";
include "header.php";
?>

<form id="formbbdd" action="index.php" method="post" enctype="multipart/form-data">

    <div class='uno'>
        <label>
            Importar nuevo fichero:
            <input type="file" id="importar-archivo" name="importar-archivo" accept="text/xml">
        </label>
        <input id="submit" type="submit" name="bbdd" value="Actualizar" />
    </div>
</form>

<?php
include "footer.php";
?>