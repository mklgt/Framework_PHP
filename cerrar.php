<?php
/**
 * Es un archivo que cierra y borra la sesión del usuario.
 * Redirecciona a la página principal.
 */
   session_start(); 
   session_unset();
   header("Location: index.php");
?>