<?php

    //**Desarollo */
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL);
    //**Desarollo */


//Cargamos librerias
require_once 'helpers/funciones.php';
require_once 'config/configurar.php';
require_once 'librerias/Base.php';
require_once 'librerias/Controlador.php';
require_once 'librerias/Core.php';

//Autoload php IMPORTANTE
spl_autoload_register(function($nombreClase){
    require_once 'librerias/'.$nombreClase.'.php';
});