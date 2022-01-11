<?php

/**
 * 
 */
class Utilidades
{

    /**
     * [verificarSelect description]
     * @param  [type] $valor     [description]
     * @param  [type] $valormenu [description]
     * @return [type]            [description]
     */
    public static function verificarSelect($valor, $valormenu)
    {
        if ($valor === $valormenu) {
            echo 'selected="selected"';
        }
    }
    /*
* Este método se utilizará para verificar el valor de 'usuario'
*
public static function verificarUsuario($valor, $valormenu)
{
    if ($valor === $valormenu) {
        echo 'value=$valor';
    }
}
*/
}
