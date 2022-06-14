<?php
/**
 * Archivo de incio de sesión de usuario, indica si el usuario
 * ha iniciado una sesión.
 */
    include "views/header.php";
    // HEADER DEBE SER LA 1ª SENTENCIA DEL NAVEGADOR NO ECHO
    echo "<h2>Sesion iniciada</h2>";
    header('Cache-Control: no cache');
    session_cache_limiter('private_no_expire');
    //session_cache_limiter('public');
    session_start();

    if (isset($_POST['usuario']) && isset($_POST['contraseña'])) {
        $_SESSION['usuario'] = $_POST['usuario']; 
        $_SESSION['contraseña'] = $_POST['contraseña'];           
    }

    header("Location: index.php");
    include "views/footer.php";
?>