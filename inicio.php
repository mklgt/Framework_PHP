<?php
/**
 * Archivo de incio de sesión de usuario, indica si el usuario
 * ha iniciado una sesión.
 */
    include "views/header.php";

    echo "<h2>Sesion iniciada</h2>";
    session_start();

    if (isset($_POST['usuario'])) {
        $_SESSION['usuario'] = $_POST['usuario'];          
    }
    if (isset($_POST['contraseña'])) {
        $_SESSION['contraseña'] = $_POST['contraseña'];        
    }

    header("Location: index.php");
    include "views/footer.php";
?>