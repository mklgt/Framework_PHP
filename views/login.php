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
        <h1 class="text-center p-4 text-light font-weight-bolder">Iniciar sesión</h1>
    </header>
    <main>
        <section>
            <?php
            $errores = [];            
            if (isset($_SESSION['usuario'])) {
                if (empty($_SESSION['usuario'])) {
                    $errores[] = "El campo usuario es obligatorio";
                }
                if (empty($_SESSION['contraseña'])) {
                    $errores[] = "El campo contraseña es obligatorio";
                }
            }
            if (!empty($errores) || !empty($errorLogin)) {
                echo "<div class='bg-danger w-75 p-3 mx-auto mt-3 fw-bold rounded'>";
                if (!empty($errorLogin)) {
                    echo "<p>" . $errorLogin . "</p>";
                }
                
                foreach ($errores as $campo) {
                    echo "<p>" . $campo . "</p>\n";
                }
                echo "</div>";
            }

            echo
            '<div class="mx-auto bg-secundario p-5 mt-3 border-grisClaro rounded wsm-90 w-40 mb-3">
                <form action="inicio.php" method="post">
                    <label class="w-100">
                        Nombre de usuario (Educa):
                        <input type="text" name="usuario" class="w-100 rounded border-0 p-1 mt-1" ';
            if (isset($_SESSION['usuario'])) {
                echo "value=" . $_SESSION['usuario'];
            }

            echo ' >
                    </label>
                    <br>
                    <label class="w-100 my-3">
                        Contraseña:
                        <input type="password" name="contraseña" class="w-100 rounded border-0 p-1 mt-1"/>
                    </label>
                    <br>
                    <input type="submit" value="Iniciar sesión" name="login" class="btn btn-success w-100 p-2 mt-3">
                </form>
                </div>';
            include 'footer.php';
            ?>