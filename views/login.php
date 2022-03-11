<!DOCTYPE html>
<html lang="es">

<head>
    <title>Reservar AULA</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>

<body>

    <header>
        <h1>Iniciar sesión</h1>
    </header>
    <main>
        <?php
        if (isset($_POST['login'])) {
            echo "login";
        }
            if (isset($_SESSION['usuario'])) {
                echo "<p>Ya existe una sesión iniciada, <a href='cerrar.php'>cerrar sesión</a></p>";
            } else {
                echo 
                '<form action="inicio.php" method="post">
                    <br>
                    <label>
                        Nombre de usuario (Educa):
                        <input type="text" name="usuario" required/>
                    </label>
                    <br>
                    <label>
                        Contraseña:
                        <input type="password" name="contraseña" required/>
                    </label>
                    <br>
                    <input type="submit" value="Iniciar sesión" name="login">
                </form>';
            }




        ?>
        <!-- <form id="formConsulta" action="index.php" method="post">
            <div class="login">
                <label>
                    Correo electrónico:
                    <input type="email" name="email">
                </label>
                <label>
                    Contraseña:
                    <input type="password" name="contraseña">
                </label>
                <input id="submit" type="submit" name="login" value="Iniciar sesión" />
            </div>
        </form> -->
    </main>
</body>

</html>