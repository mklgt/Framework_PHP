<?php
include "helper/Utilidades.php";
include "helper/Input.php";
include "header.php";
echo "<h2>Sesion iniciada</h2>";
session_start();

if (isset($_POST['usuario'])) {
    $_SESSION['usuario'] = $_POST['usuario'];          
}
if (isset($_POST['contraseña'])) {
    $_SESSION['contraseña'] = $_POST['contraseña'];        
}

if (isset($_SESSION['usuario'])) {
    echo "<p>Sesión iniciada como: " . $_SESSION['usuario'] . "</p>"; 
    echo "<p>Contraseña: " . $_SESSION['contraseña'] . "</p>"; 
    echo "<form action='cerrar.php' method='post'><input type='submit' value='Cerrar Sesión'></form>";
} else {
    echo "<p>No hay ninguna sesión iniciada<br><a href='login.php'>Registrarse</a></p>";
}
include "footer.php";
?>