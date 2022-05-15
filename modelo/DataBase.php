<?php
include "IDataBase.php";
include 'config/config.php';
/**
 * @method void conectar()
 * @method void desconectar()
 * @method void createDb()
 * @method void createTables()
 * @method void ejecutarSql()
 * @method void ejecutarSqlActualizacion()
 * @method void insertarInformacion()
 * @method void consultarInformacion()
 */
class DataBase implements IDataBase
{
    private $conexion;

    //Array que guarda las tablas que se van a crear en la base de datos
    private $tables = array(
        "tramo" => array('id', 'submarco', 'dia', 'indice', 'horaEntrada', 'horaSalida', 'Tipo', 'clavX'),
        "aula" => array('id', 'nombre', 'abreviatura', 'descripcion', 'dedicada', 'plantilla')
    );

    //Crea una conexión sin base de datos, ejecuta la función que la crea y añade las tablas. Con control de errores y la API PDO
    public function conectar()
    {
        try {
            $this->conexion = new PDO('mysql:host=' . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
            $this->conexion->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
            $this->conexion->exec('SET names utf8');

            $this->dropTables();
            $this->createTables($this->conexion, $this->tables);
            $this->consultarInformacion();
        } catch (Exception $ex) {
            //Añadir este error en el array de errores
            //$error = "Error:no se pudó conectar a la base de datos;";
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
     * Se le pasa como parámetros la conexion creada y el nombre de la base de datos a crear.
     * @param  object $db_name
     */
    //Función que crea la base de datos, recibe la conexión creada y el nombre de esta
    public function createDb($db_name)
    {
        $create = "CREATE DATABASE IF NOT EXISTS $db_name";
        $this->conexion->ejecutarSql($create);
        $use = "USE $db_name";
        $this->conexion->ejecutarSql($use);
    }

    /**
     * Función que crea las tablas definidas anteriormente en la clase
     */
    public function createTables()
    {
        $tables = $this->tables;
        foreach ($tables as $table => $campos) {
            foreach ($campos as $campo) {
                if ($campo == "id") {
                    $this->conexion->query("CREATE TABLE IF NOT EXISTS $table ( $campo INT NOT NULL AUTO_INCREMENT, PRIMARY KEY($campo) )");
                } else {
                    try {
                        $this->conexion->query("ALTER TABLE $table ADD $campo VARCHAR(40)");
                    } catch (Exception $ex) {
                        continue;
                    }
                }
            }
        }
    }

    /**
     * Función que elimina las tablas para poder definirlas de nuevo
     */
    public function dropTables()
    {
        $this->conexion->query("DROP TABLE IF EXISTS tramo, aula");
    }

    /**
     * Ejecurta la consulta SQL (No usar esta)
     * @param  string $sql
     * @return mixed $result el resultado de la consulta;
     */
    public function ejecutarSql($sql)
    {
        $resul = $this->conexion->query($sql);
        return $resul;
    }

    /**
     * Ejecurta la consulta SQL (Usar esta)
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
            //echo "<p>Error: " . $e->getMessage() . "</p>\n";
        }
    }

    /**
     * Función que se ejecuta un sola vez al crearse la base de datos e introducir los datos a consultar
     * @param  array $args
     * @param  string $tablaInsercion
     */
    public function insertarInformacion($args, $tablaInsercion)
    {
        try {
            switch ($tablaInsercion) {
                case 'tramo':
                    $sql = "INSERT INTO tramo (submarco, dia, indice, horaEntrada, horaSalida, Tipo, clavX) VALUES (?, ?, ?, ?, ?, ?, ?)";
                    break;
                case 'aula':
                    $sql = "INSERT INTO aula (nombre, abreviatura, descripcion, dedicada, plantilla) VALUES (?, ?, ?, ?, ?)";
                    break;
                default:
                    break;
            }
            $this->ejecutarSqlActualizacion($sql, $args);
        } catch (Exception $e) {
            switch ($tablaInsercion) {
                case 'tramo':
                    $sql = "UPDATE tramo SET submarco = ?, dia = ?, indice = ?, horaEntrada = ?, horaSalida = ?, Tipo = ?, clavX = ?";
                    break;
                case 'aula':
                    $sql = "UPDATE aula SET nombre = ?, abreviatura = ?, descripcion = ?, dedicada = ?, plantilla = ?";
                    break;
                default:
                    break;
            }
            $this->ejecutarSqlActualizacion($sql, $args);
            exit;
        }
    }

    /**
     * Se ejecuta una vez a la hora de crear la base de datos del xml especificado.
     * Revisa el xml por campos, recoge los datos para columnas de la tabla, los guarda en un array de argumentos para insertarlos.
     * @return void
     */
    public function consultarInformacion()
    {
        if (file_exists('./bbdd/bbdd.xml')) {
            $xml = simplexml_load_file('./bbdd/bbdd.xml');
            $xmla = get_object_vars($xml);
            foreach ($xmla as $coleccion) {
                $valores = (array)$coleccion;
                foreach ($valores as $valor) {
                    $valor = (array)$valor;
                    if (is_array($valor)) {
                        foreach ($valor as $nombreTabla => $valoresTabla) {
                            // Identificar tabla de "aulas"
                            if (array_key_exists("nombre", (array)$valoresTabla)) {
                                if (array_key_exists("dedicada", (array)$valoresTabla)) {
                                    $nombreTabla = "aula";
                                    $valoresTabla = (array)$valoresTabla;
                                    $valoresInsert = [];
                                    foreach ($valoresTabla as $dato => $da) {
                                        $valoresInsert[] = $da;
                                    }
                                    $this->insertarInformacion($valoresInsert, $nombreTabla);
                                }
                            }
                            if ($nombreTabla == "tramo") {
                                $valoresTabla = (array)$valoresTabla;
                                foreach ($valoresTabla as $dato) {
                                    $dato = (array)$dato;
                                    $valoresInsert = [];
                                    foreach ($dato as $dat => $da) {
                                        $valoresInsert[] = $da;
                                    }
                                    $this->insertarInformacion($valoresInsert, $nombreTabla);
                                }
                            }
                        }
                    }
                }
            }
        } else {
            exit('Error abriendo bbdd.xml.');
        }
    }
}
