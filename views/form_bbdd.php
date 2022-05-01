<?php
include "helper/Utilidades.php";
include "helper/Input.php";
include "header.php";
?>

<form id="formbbdd" action="index.php" method="post" enctype="multipart/form-data">

    <div class='bg-secundario p-3 mx-auto w-75 my-3 rounded'>
        <label>
            Importar nuevo fichero:
            <br>
            <input type="file" id="importar-archivo" name="importar-archivo" accept="text/xml" class="mt-2">
        </label>
        <input id="submit" type="submit" name="bbdd" value="Actualizar" />
    </div>
</form>

<?php
include "footer.php";
?>