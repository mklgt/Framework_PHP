<?php
/**
 * Es un archivo que cierra y borra la sesión del usuario.
 * Redirecciona a la página principal.
 */
   session_start(); 
   header('Cache-Control: no cache');
  session_cache_limiter('private_no_expire');
  //session_cache_limiter('public');
   session_unset();
   header("Location: index.php");
?>