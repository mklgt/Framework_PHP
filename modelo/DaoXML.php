<?php

class DaoXML
{

    private $db;
    private   $tables = array(
        "tramo" => array('id', 'submarco', 'dia', 'indice', 'horaEntrada', 'horaSalida', 'Tipo', 'clavX'),
        "aula" => array('id', 'nombre', 'abreviatura', 'descripcion', 'dedicada', 'plantilla'),
        "ocupadas" => array('id', 'nombre', 'dia', 'indice')

    );

    public function __construct()
    {
        $this->db = new DataBase();
        //Array que guarda las tablas que se van a crear en la base de datos

    }

    // NO SE UTILIZA
    public function createDb($db_name)
    {
        $create = "CREATE DATABASE IF NOT EXISTS $db_name";
        $this->db->conectar();
        $this->db->ejecutarSql($create);
        $use = "USE $db_name";
        $this->db->ejecutarSql($use);
        $this->db->desconectar();
    }
    // Crea las tablas tramo y aula
    public function createTables()
    {
        $this->db->conectar();
        $tables = $this->tables;
        foreach ($tables as $table => $campos) {
            foreach ($campos as $campo) {
                if ($campo == "id") {
                    $consulta = "CREATE TABLE IF NOT EXISTS $table ( $campo INT NOT NULL AUTO_INCREMENT, PRIMARY KEY($campo) )";
                    $this->db->ejecutarSql($consulta);
                    //$this->conexion->query("CREATE TABLE IF NOT EXISTS $table ( $campo INT NOT NULL AUTO_INCREMENT, PRIMARY KEY($campo) )");
                } else {
                    try {
                        $consulta = "ALTER TABLE $table ADD $campo VARCHAR(40)";
                        $this->db->ejecutarSql($consulta);
                        //$this->conexion->query("ALTER TABLE $table ADD $campo VARCHAR(40)");
                    } catch (Exception $ex) {
                        continue;
                    }
                }
            }
        }
        $this->db->desconectar();  //o nada que se desconectará
    }

    /**
     * Función que elimina las tablas para poder definirlas de nuevo
     */
    public function dropTables($opcion)
    {
        $this->db->conectar();
        if ($opcion == "datosForm") {
            $consulta = "DROP TABLE IF EXISTS tramo, aula";
        } else {
            $consulta = "DROP TABLE IF EXISTS ocupadas";
        }
        $this->db->ejecutarSql($consulta);
        $this->db->desconectar();
    }


    public function insertarXML($opcion)
    {
        $archivoImportado = $_FILES['importar-archivo'];
        move_uploaded_file($archivoImportado['tmp_name'], './bbdd/bbdd.xml');
        if ($opcion == "actualizar") {
            $this->insertarDatosArchivoXML();
        } else {
            $this->insertarDatosArchivoXMLOcupadas();
        }        
    }

    public function insertarCSV()
    {
        $archivoImportado = $_FILES['archivoCSV'];
        move_uploaded_file($archivoImportado['tmp_name'], './usuarios/usuarios.csv');
        $csv = array_map('str_getcsv', file('./usuarios/usuarios.csv'));
        $this->insertarDatosCSV($csv);
    }

    public function insertarDatosCSV($csv) {
        $this->db->conectar();
        $this->db->ejecutarSql("DELETE FROM sesiones2");
        $sql = "INSERT INTO sesiones2 (usuario, contraseña) VALUES (?, ?)";
        foreach ($csv as $key) {
            $sql = "INSERT INTO sesiones2 (usuario, contraseña) VALUES (?, ?)";
            $args = [$key[0], $key[1]];
            $this->db->ejecutarSqlActualizacion($sql, $args);
        }
        $this->db->desconectar();        
    }

    /**
     * Función que se ejecuta un sola vez al crearse la base de datos e introducir los datos a consultar
     * @param  array $args
     * @param  string $tablaInsercion
     */
    public function insertarInformacion($args, $tablaInsercion)
    {
        $this->db->conectar();
        try {
            switch ($tablaInsercion) {
                case 'tramo':
                    $sql = "INSERT INTO tramo (submarco, dia, indice, horaEntrada, horaSalida, Tipo, clavX) VALUES (?, ?, ?, ?, ?, ?, ?)";
                    break;
                case 'aula':
                    $sql = "INSERT INTO aula (nombre, abreviatura, descripcion, dedicada, plantilla) VALUES (?, ?, ?, ?, ?)";
                    break;
                case 'ocupadas':
                    $sql = "INSERT INTO ocupadas (nombre, dia, indice) VALUES (?, ?, ?)";
                    break;
                default:
                    break;
            }
            $this->db->ejecutarSqlActualizacion($sql, $args);
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
            $this->db->ejecutarSqlActualizacion($sql, $args);
            exit;
        }
    }

    /**
     * Se ejecuta una vez a la hora de crear la base de datos del xml especificado.
     * Revisa el xml por campos, recoge los datos para columnas de la tabla, los guarda en un array de argumentos para insertarlos.
     * @return void
     */
    //Tratar sesionesLectivas para extraer el aula y los tramos día e índica (hora) 
    public function insertarDatosArchivoXML()
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
    
    public function insertarDatosArchivoXMLOcupadas()
    {
        if (file_exists('bbdd/bbdd.xml')) {
            $xml = simplexml_load_file('bbdd/bbdd.xml');
            $xmla = get_object_vars($xml);
        
            foreach ($xmla as $coleccion) {
                $valores = (array)$coleccion;
        
                foreach ($valores as $nombre => $valor) {
                    $valor = (array)$valor;
                    if (is_array($valor) && $nombre == "sesion") {
                        foreach ($valor as $nombreTabla => $valoresTabla) {
                            $valoresInsert = [];
                            $valoresTabla = (array)$valoresTabla;
                            foreach ($valoresTabla as $nombreValorTabla => $valorTabla) {
                                if ($nombreValorTabla == "listaDeAulas") {
                                    $valorTabla = (array)$valorTabla;
                                    $nombreOcupado = $valorTabla['aula'];
                                    $valoresInsert[] = $nombreOcupado;
                                }
                                if ($nombreValorTabla == "plantilla") {
                                    foreach ($valorTabla as $datos) {
                                        foreach ($datos->attributes() as $dato => $value) {
                                            switch ($dato) {
                                                case 'dia':
                                                    $diaOcupado = $value;
                                                    $valoresInsert[] = $diaOcupado;
                                                    break;
                                                case 'indice':
                                                    $indiceOcupado = $value;
                                                    $valoresInsert[] = $indiceOcupado;
                                                    break;
                                                default:
                                                    break;
                                            }
                                        }
                                        $this->insertarInformacion($valoresInsert, "ocupadas");
                                        $valoresInsert = [];
                                    }
                                }  
                            }
                        }
                    }
                }
            }
        }
    }
}
