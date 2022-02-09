<?php
include "IDataBase.php";
include 'config/config.php';
class DataBase implements IDataBase
{
    private $conexion;

    public function conectar()
    {
        try {
            $this->conexion = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
            //$this->conexion = new PDO('mysql:host=localhost;dbname=dbaulaweb', $usuario, $contraseña);
            $this->conexion->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
            $this->conexion->exec('SET names utf8');
        } catch (Exception $ex) {
            //Añadir este error en el array de errores
            //$error = "Error:no se pudó conectar a la base de datos;";
            echo "Error al conectar en la base de datos" . $ex->getMessage();
            exit();
        }
    }

    public function desconectar()
    {
        $this->conexion = null;
    }


    public function ejecutarSql($sql)
    {
        $resul = $this->conexion->query($sql);
        return $resul;
    }

    public function ejecutarSqlActualizacion($sql, $args)
    {
        try {
            $resul = $this->conexion->prepare($sql);
            $resul->execute($args);
            //
            // if (!$resul) {
            //     echo "<p>Error en la consulta.</p>";
            // } else {
            //     return $resul;
            // }

            return $resul;
        } catch (Exception $e) {
            echo "<p>Error: " . $e->getMessage() . "</p>\n";
        }
        
    }
    /*public function ejecutarSqlActualizacionPRUEBA($sql, $args)
{
try {

$resul = $this->conexion->prepare($sql);
foreach ($args as $arg => $valor) {
$resul->bindParam($arg, $valor, PDO::PARAM_STR, 50);
}
$resul->execute();
//
// if (!$resul) {
// echo "

//Error en la consulta.
";
// } else {
// return $resul;
// }
var_dump($resul);
return $resul;
} catch (Exception $e) {
echo "

Error: " . $e->getMessage() . "
\n";
}
}*/
}
