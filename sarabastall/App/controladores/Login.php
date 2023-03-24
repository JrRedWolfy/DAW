<?php
    class Login extends Controlador{

        public function __construct(){

            $this->loginModelo = $this->modelo('LoginModelo');

        }
        
        public function index($error =''){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $this->datos['usuario'] = trim($_POST['usuario']);
                $this->datos['password'] = trim($_POST['pass']);

                $usuarioSesion = $this->loginModelo->loginUsuario($this->datos);

                if(isset($usuarioSesion) && !empty($usuarioSesion)){  //Si tiene datos el objeto devuelto entramos
                    
                    Sesion::crearSesion($usuarioSesion);

                    switch ($_SESSION['usuarioSesion']->Id_Rol){
                        case 1:
                            print_r("administrador");
                            redireccionar("/admin");
                            break;

                        case 2:
                            print_r("trabajador");
                            redireccionar("/trabajador");
                            break;

                        case 3:
                            print_r("Default");
                            redireccionar("/defecto");
                            break;

                        case 4:
                            print_r("master");
                            redireccionar("/master");
                            break;

                        case 5:
                            print_r("profesor");
                            redireccionar("/profesor");
                            break;
                    }

                } else{
                    redireccionar('/login/index/error_1');
                }

            }else{

                if(Sesion::sesionCreada()){  //si ya estamos logueados redireccionamos
                    switch ($_SESSION['usuarioSesion']->Id_Rol){
                        case 1:
                            print_r("administrador");
                            redireccionar("/admin");
                            break;

                        case 2:
                            print_r("trabajador");
                            redireccionar("/trabajador");
                            break;

                        case 3:
                            print_r("Default");
                            redireccionar("/defecto");
                            break;

                        case 4:
                            print_r("master");
                            redireccionar("/master");
                            break;

                        case 5:
                            print_r("profesor");
                            redireccionar("/profesor");
                            break;
                    }
                }
                $this->datos['error'] = $error;
                $this->vista('login', $this->datos);
            }
        }

        public function logout(){
            Sesion::cerrarSesion();
            redireccionar('/');
            //$this->vista('primera', $this->datos);
        }
    }
?>