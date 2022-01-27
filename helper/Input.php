<?php

/**
 * @method string get($dato)
 * @method boolean siEnviado()
 * @method string o array filtrarDato($datos)
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
            $campo = Input::filtrarDato($dato);
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
     * @param  string $datos
     * @return string dependiendo de $datos
     */
    public static function filtrarDato($datos)
    {
        if (isset($_POST[$datos])) {
            //$campo = $_POST[$datos];

            if (is_array($datos)) {
                for ($i = 0; $i < count($datos); $i++) {
                    $campo = htmlspecialchars(strip_tags($_POST[$datos[$i]]), ENT_QUOTES);
                }
            } else {
                $campo = htmlspecialchars(strip_tags($_POST[$datos]), ENT_QUOTES);
            }

            //$_POST['usuario'] = htmlspecialchars(strip_tags($_POST[$datos]), ENT_QUOTES);
            echo $_POST['usuario'];

            // if ($campo !== strip_tags($campo) || str_contains($campo, ">")) {

            //     $campo = "";
            // }
            return $campo;
        }
    }
}
