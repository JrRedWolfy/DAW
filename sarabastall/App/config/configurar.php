<?php

    // *** Desarrollo *** //
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    // *** Desarrollo *** //


    //Ruta de la aplicación
    define('RUTA_APP', dirname(dirname(__FILE__)));

    //Ruta url, Ejemplo: http://localhost/atletismo
    define('RUTA_URL', 'https://192.168.4.237'); // Si va ha cambiar esto, revisar listar_elementos, que dara problemas

    define('RUTA_URL_STATIC', 'https://192.168.4.237/public');


    DEFINE('NOMBRE_SITIO', 'SARABASTALL');

    //echo dirname(dirname(__FILE__));
    //echo dirname(__FILE__);
    //echo RUTA_APP;
    //echo RUTA_URL;

    //Configuración de la Base de datos
    define('DB_HOST', '192.168.16.4:3306');
    define('DB_USUARIO', 'root');
    define('DB_PASSWORD', 'root');
    define('DB_NOMBRE', 'Sarabastall3242');
?>