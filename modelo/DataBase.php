<?php
include "IDataBase.php";
include 'config/config.php';
/**
 * @method void conectar()
 * @method void desconectar()
 * @method void ejecutarSql()
 * @method void ejecutarSqlActualizacion()
 * 
 *  */
class DataBase implements IDataBase
{
    private $conexion;


    //Crea una conexión sin base de datos, ejecuta la función que la crea y añade las tablas. 
    //Con control de errores y la API PDO
    // @ac es la variable para que al comprobar la sesión no borre y cree las tablas
    public function conectar()
    {
        try {
            $this->conexion = new PDO('mysql:host=' . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
            $this->conexion->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
            $this->conexion->exec('SET names utf8');        
        } catch (Exception $ex) {
            echo "Error al conectar en la base de datos" . $ex->getMessage();
            exit();
        }
    }

    //Asigna null a la conexión para desconectar de la base de datos
    public function desconectar()
    {
        $this->conexion = null;
    }

    /**
     * Ejecurta la consulta SQL 
     * @param  string $sql
     * @return mixed $result el resultado de la consulta;
     */
    public function ejecutarSql($sql)
    {
        $resul = $this->conexion->query($sql);
        return $resul;
    }

    /**
     * Ejecutar la consulta SQL (Usar esta)
     * @param  string $sql
     * @param  array $args
     * @return mixed $result;
     */
    public function ejecutarSqlActualizacion($sql, $args)
    {
        try {
            $resul = $this->conexion->prepare($sql);
            $resul->execute($args);
            return $resul;
        } catch (Exception $e) {
            // No se necesita mensaje, continua con la ejecución
        }
    }
}
