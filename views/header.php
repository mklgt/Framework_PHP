<!DOCTYPE html>
<html lang="es">

<head>
    <title>Reservar AULA</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="icon" type="image/x-icon" href="./img/favicon.ico">
</head>

<body class="bg-principal">

    <header class="bg-grisClaro border border-start-0 border-end-0 border-3 border-dark">
        <h1 class="text-center p-4 text-light font-weight-bolder">
            <a href="index.php" class="text-decoration-none text-light">AULA</a>
        </h1>
        <?php
            if (isset($_SESSION['usuario'])) {
                echo "<form action='cerrar.php' method='post'><input type='submit' value='Cerrar Sesión' class='position-absolute top-0 end-0 mt-2 mx-2 btn btn-dark'></form>";
            }
        ?>
    </header>

    <nav class="bg-secundario">
        <form id="formPag" action="index.php" method="post">
        <button type="submit" name="pagina" value="consulta" class="btn btn-outline-secondary border-0 rounded-0 fs-6 p-3">Consultar Aula</button>
            <button type="submit" name="pagina" value="formulario" class="btn btn-outline-secondary border-0 rounded-0 fs-6 p-3">Reservar</button>
            <button type="submit" name="pagina" value="editar" class="btn btn-outline-secondary border-0 rounded-0 fs-6 p-3">Editar reservas</button>
            <?php 
            if(isset($_SESSION['usuario']) && $_SESSION['usuario']=="jefeestudios"){               
                echo '<button type="submit" name="pagina" value="todasReservas" class="btn btn-outline-secondary border-0 rounded-0 fs-6 p-3">Reservas</button>';                
                echo '<button type="submit" name="pagina" value="bbdd" class="btn btn-outline-secondary border-0 rounded-0 fs-6 p-3">Base de Datos</button>'; 
            }?>
        </form>
    </nav>

    <main>
        <section>