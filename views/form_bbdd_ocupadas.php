<?php
include "helper/Utilidades.php";
include "helper/Input.php";
include "header.php";
?>

<form id="formbbdd" action="index.php" method="post" enctype="multipart/form-data">

    <div class='bg-secundario p-3 mx-auto w-75 my-3 rounded'>
        <p class="fw-bold">Insertar datos de aulas que estarán ocupadas a lo largo del curso</p>
        <label>
            Importar nuevo fichero:
            <br>
            <input type="file" id="importar-archivo" name="importar-archivo" accept="text/xml" class="mt-2">
        </label>
        <input id="submit" type="submit" name="bbdd" value="Insertar aulas ocupadas" />
        <?php
        if (isset($resultado)) {
            echo "<br><br>" . "<b>".$resultado."</b>";
        }
        ?>
    </div>
</form>
<form id="formUsuarios" action="index.php" method="post" enctype="multipart/form-data">
    <div class='bg-secundario p-3 mx-auto w-75 my-3 rounded'>
    <p class="fw-bold">Importar fichero con los datos de inicio de sesión de los usuarios</p>
    <label>
        Importar fichero con datos de usuarios:
        <br>
        <input type="file" name="archivoCSV" id="archivoCSV" accept=".csv" />
    </label>
        <input type="submit" name="csvUsers" value="Subir usuarios" />
    </div>
</form>

<?php
include "footer.php";
?>