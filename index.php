<?php  
/**
 * Proyecto MVC en SPA 
 *
 * @author Asier Gonzalez Gamboa <agonzalgam1@educacion.navarra.es> Mikel Goicoechea <mgoicoeoca@educacion.navarra.es>
 * @copyright 2021 Asier Gonzalez Gamboa & Mikel Goicoechea Ocariz
 * @license http://www.fsf.org/licensing/licenses/gpl.txt GPL 2 or later
 * @version 2022-01-13
 * @link http://www.example.org
 * 
 * Una aplicación web en PHP-OO, con la arquitectura MVC  que incorpore un UML similar al de las presentaciones 
 *  del material Inicial que se irá aportando
 * 
 * La aplicación implementará el patrón de diseño DAO  para el acceso a la Base de datos a través de la API.
 */
    set_time_limit(300);
     require_once 'controladores/Controlador.php';
     $controlador = new Controlador();
     $controlador->run();
?>