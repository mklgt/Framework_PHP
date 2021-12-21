<?php
    class Input
    {


        // Función que devuelve el dato si está definido sino devuelve ""
        public static function get($dato)
        {
            if (isset($_POST[$dato])) {
                $campo = $_POST[$dato];
                //$campos = Input::filtrarDato($campo);
            } else {
                $campo = "";
            }
            return $campo;
        }
    
        // Función que devuelve true o flase dependiendo de si ha habido envio o no
        public static function siEnviado()
        {
            return (!empty($_POST)) ? true : false;
        }


    }




?>