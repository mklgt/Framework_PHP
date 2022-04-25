<!DOCTYPE html>
<html lang="es">

<head>
    <title>Reservar AULA</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>

<body class="bg-principal">

    <header class="bg-grisClaro border border-start-0 border-end-0 border-3 border-dark">
        <h1 class="text-center p-4 text-light font-weight-bolder">Iniciar sesión</h1>
    </header>
    <main>
        <section>
            <?php
            if (isset($_POST['login'])) {
                echo "login";
            }
            if (isset($_SESSION['usuario'])) {
                echo "<p>Ya existe una sesión iniciada, <a href='cerrar.php'>cerrar sesión</a></p>";
            } else {
                echo
                '<div class="mx-auto bg-secundario p-5 mt-3 border-grisClaro rounded wsm-90 w-40 mb-3">
                <form action="inicio.php" method="post">
                    <label class="w-100">
                        Nombre de usuario (Educa):
                        <input type="text" name="usuario" required class="w-100 rounded border-0 p-1 mt-1"/>
                    </label>
                    <br>
                    <label class="w-100 my-3">
                        Contraseña:
                        <input type="password" name="contraseña" required class="w-100 rounded border-0 p-1 mt-1"/>
                    </label>
                    <br>
                    <input type="submit" value="Iniciar sesión" name="login" class="btn btn-success w-100 p-2 mt-3">
                </form>
                </div>';
            }

            include 'footer.php';
            ?>