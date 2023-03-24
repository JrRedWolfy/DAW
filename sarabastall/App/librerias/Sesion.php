<?php

    class Sesion{

        public static function crearSesion($usuarioSesion){
            $sessionTime = 365 * 24 * 60 * 60;

            session_set_cookie_params($sessionTime);
            session_start();
            session_regenerate_id();

            $_SESSION["usuarioSesion"] = $usuarioSesion;

        }

        public static function iniciarSesion(&$datos = []){
            session_start();

            if(isset($_SESSION["usuarioSesion"])){
                $datos['usuarioSesion'] = $_SESSION["usuarioSesion"];  //pasamos por referencia los datos de la sesion

            }else{
                session_destroy();
                redireccionar('/login');
            }
        }

        public static function sesionCreada(&$datos = []){
            session_start();

            if(isset($_SESSION["usuarioSesion"])){
                $datos['usuarioSesion'] = $_SESSION["usuarioSesion"];  
                return true;
            }else{
                return false;
            }
        }

        public static function cerrarSesion(){
            session_start();

            setcookie(session_name(), '', time() -3600, "/");
            session_unset();

            session_destroy();
            $_SESSION = array();
        }
    }
?>