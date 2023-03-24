<?php
    /* 
        Mapear la url ingresada en el navegador
        1.Controlador
        2.Metodo
        3. parametros
        Ejemplo: /articulo/actualizar/4
    */
    class Core{
        protected $controladorActual = 'Inicio';
        protected $metodoActual = 'index';
        protected $parametros = [];

        public function __construct(){
            $url = $this->getUrl();
            
            if (isset($url[0])){//buscamos en controladores si el controlador existe
                if (file_exists('../App/controladores/'.ucwords($url[0]).'.php')){ //si existe se configura como controlador por defecto
                    $this->controladorActual = ucwords($url[0]); //eliminamos la primera posición de $url
                    unset($url[0]);
                }
            }

            require_once '../App/controladores/'.$this->controladorActual.'.php';
            $this->controladorActual = new $this->controladorActual;
        
            //Obtener la segunda parte de la url: el metodo
            if(isset($url[1])){
                if(method_exists($this->controladorActual,$url[1])){ //Miramos que exista el url[1] que representaria el metodo
                    $this->metodoActual= $url[1];
                    unset($url[1]); //Eliminas la declaración
                }
            }

            //Obtenemos los parametros
            $this->parametros = $url ? array_values($url) : [];
            
            //Llamamos al metodo del controlador
            call_user_func_array([$this->controladorActual,$this->metodoActual],$this->parametros);
        }

        public function getUrl(){
            if (isset($_GET['url'])){ //isset = Si existe la url
                $url = rtrim($_GET['url'], '/'); //rtrim = Si existe un (o varios) caracter concreto al final lo elimina en este caso '/'

                $url = ltrim($_GET['url'], '/'); //rtrim = Si existe un (o varios) caracter concreto al final lo elimina en este caso '/'

                $url = filter_var($url, FILTER_SANITIZE_URL); //filter = filtra los caracteres especificados en funcion de un comando de php
                
                $url = explode('/', $url); //explode = Genera un array a partir de una funcion separados por un caracter especificado
                
                return $url;
            }
        }
    }
?>