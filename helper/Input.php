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
        if (isset($_SESSION[$dato])) {
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
        return (!empty($_POST['usuario']) || !empty($_POST['aula']) || !empty($_POST['fecha']) || !empty($_POST['hora-desde']) || !empty($_POST['hora-hasta'])) ? true : false;
    }

    /**
     * Devuelve los datos saneados de cualquier fragmento
     * de código que el usuario pueda insertar en los campos
     * @param  string $datos
     * @return string dependiendo de $datos
     */
    public static function filtrarDato($datos)
    {
        if (isset($_SESSION[$datos])) {
            $campo = $_SESSION[$datos];

            // Comprueba si el texto introducido en el campo contiene caracteres de etiquietas 
            if ($campo !== strip_tags($campo) || str_contains($campo, ">")) {

                $campo = "";
            }
            return $campo;
        }
    }
}
