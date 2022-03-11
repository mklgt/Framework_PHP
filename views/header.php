<!DOCTYPE html>
<html lang="es">

<head>
    <title>Reservar AULA</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="icon" type="image/x-icon" href="./img/favicon.ico">
</head>

<body>

    <header>
        <h1>
            <a href="index.php">AULA</a>
        </h1>
        <?php
            if (isset($_SESSION['usuario'])) {
                echo "<form action='cerrar.php' method='post'><input type='submit' value='Cerrar Sesión' class='cerrar-sesion'></form>";
            }
        ?>
    </header>

    <nav>
        <form id="formPag" action="index.php" method="post" class="nav">
        <button type="submit" name="pagina" value="consulta" class="btn-link">Consultar Aula</button>
            <button type="submit" name="pagina" value="formulario" class="btn-link">Reservar</button>
            <?php 
            if($_SESSION['usuario']=="jefeestudios"){
            echo '<button type="submit" name="pagina" value="bbdd" class="btn-link">Base de Datos</button>';}?>
        </form>
    </nav>

    <main>
        <section>