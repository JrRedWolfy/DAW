<?php
    // Controlador principal de todos los controladores
    // Se encarga de cargar los modelos y las vistas

    // #[AllowDynamicProperties]
    class Controlador{

        protected $datos = [];

        //Cargar modelo
        public function modelo($modelo){
            require_once '../App/modelos/'.$modelo.'.php';
            return new $modelo;
        }

        //Cargar vista
        public function vista($vista, $datos = []){
            //Comprobamos si existe el archivo
            if (file_exists('../App/vistas/'.$vista.'.php')){
                require_once '../App/vistas/'.$vista.'.php';
            }
            else{
                die('La vista no existe');
            }
        }

        // cargar vista api
        public function vistaApi($datos){
            header('Access-Control-Allow-Origin: *');
            header('Content-Type: application/json');
            echo json_encode($datos);
            exit();
        }

    }
?>