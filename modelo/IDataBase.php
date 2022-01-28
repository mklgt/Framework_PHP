<?php

interface IDataBase{

//ESTO NO VA EN EL PROYECTO
//LO HA QUITADO 😢

public function conectar();
public function desconectar();
public function ejecutarSql($sql);
public function ejecutarSqlActualizacion($sql, $args);


}
