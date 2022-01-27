<?php

class DataBase implements IDataBase
{
    private $conexion;

    public function conectar()
    {
        try {
            //$this->conexion = new PDO('mysql:host=localhost;dbname='.DB_NAME,DB_USER, DB_PASS);
            $this->conexion = new PDO('mysql:host=localhost;dbname=dbaulaweb,null, null');
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
        //Si tenemops variable de resultado que se guarda pues lo piondriamos en null tambien por si acaso
        $this->conexion = null;
    }


    public function ejecutarSql($sql)
    {
        //hay que hacer un try catch
        $resul = $this->conexion->query($sql);
        return $resul;
    }

    public function ejecutarSqlActualizacion($sql, $args)
    {
        //lo mismo que arriba pero con UPDATE
        //y mas seguro


    }
}
