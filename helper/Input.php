<?php

/**
 * @method string get($dato)
 * @method boolean siEnviado()
 * @method string o array filtrarDato($datos)
 * @todo filtrarDato diferenciar si $datos es dato simple o array
 */
class Input
{

    /**
     * Función que devuelve el dato si está definido sino devuelve ""
     * @param  string $dato
     * @return string devuelve el dato filtrado y saneado
     */
    public static function get($dato)
    {
        if (isset($_POST[$dato])) {
            $campo = $_POST[$dato];
            $campo = Input::filtrarDato($campo);
        } else {
            $campo = "";
        }
        return $campo;
    }

    /**
     * Función que devuelve true o flase dependiendo de si ha habido envio o no
     * @return boolean
     */
    public static function siEnviado()
    {
        return (!empty($_POST)) ? true : false;
    }

    /**
     * Devuelve los datos saneados de cualquier fragmento
     * de código que el usuario pueda insertar en los campos
     * @param  string o array $datos
     * @return string o array dependiendo de $datos
     */
    public static function filtrarDato($datos)
    {
        if (isset($_POST[$datos])) {
            //TODO: Hay que diferenciar entre dato simple o array
            $campo = $_POST[$datos];
            return htmlspecialchars($campo);
        }
    }
}
