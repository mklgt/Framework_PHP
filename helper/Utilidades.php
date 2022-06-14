<?php

/**
 * @method string verificarSelect($valor, $valormenu)
 */
class Utilidades
{

    /**
     * Comprueba y recupera los valores de los controles introducidos correctamente
     * @param  string $valor
     * @param  string $valormenu
     * @return string echo 'value=' . $valor;
     */
    public static function verificarValorCampo($valor, $valormenu)
    {
        if ($valor === $valormenu) {
            echo 'value=' . $valor;
        }
    }
}
