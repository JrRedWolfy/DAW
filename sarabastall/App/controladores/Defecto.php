<?php
    class Defecto extends Controlador{

        public function __construct(){

            Sesion::iniciarSesion($this->datos);

            //$this->datos["usuarioSesion"] = $this->asesoriaModelo->getPersona(1);
            $this->pedirConsultarPrestamo = $this->modelo('PedirConsultarPrestamo');
            $this->prestamoModelo = $this->modelo('PrestamoModelo');

            $this->datos["controlador"] = "defecto";
            $this->datos["rolesPermitidos"] = [3];


            if(!tienePrivilegios($this->datos["usuarioSesion"]->Id_Rol, $this->datos["rolesPermitidos"])){
                exit();
            }

        }
        
        public function index(){

            $this->vista("menuDefault",$this->datos);

        }

        public function solicitar_prestamo(){

            $this->datos["tipoprestamo"] = $this->pedirConsultarPrestamo->gettipoPrestamo();

            $this->datos["nombrepersona"] = $this->pedirConsultarPrestamo->getpersonaPrestamo();


            $this->vista("gestion/prestamos/pedirPrestamo",$this->datos);
        }

        public function ver_prestamos(){

            $id = $this->datos["usuarioSesion"]->Id_Persona;
            $this->datos["estados"] = $this->pedirConsultarPrestamo->get_estados();
            $this->datos["PrestamosTotales"] = $this->pedirConsultarPrestamo->get_prestamos_usuario($id);
            $this->vista("gestion/prestamos",$this->datos);

        }

        public function see_abono($id_prestamo, $resto = 0){
            
            $this->datos["prestamo"] = $this->prestamoModelo->get_prestamo($id_prestamo);
            $this->datos["abonos"] = $this->prestamoModelo->get_abonos($id_prestamo);
            $this->vista("gestion/ver_abonos",$this->datos);
        }


        public function pedir_prestamo(){
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                $prestamo = $_POST;

                if(!$_POST['concepto'] && !$_POST['importe'] && !$_POST['fecha_fin'] && !$_POST['Id_TipoPrestamo']){
                    //  redireccionar('/admin/gestionar_personas');
                }else{   
                    if($this->pedirConsultarPrestamo->addPrestamoNombre($prestamo, $this->datos["usuarioSesion"]->Id_Persona)){
                        redireccionar('/defecto');
                    }else{
                        echo "Se ha producido un error";
                }

                }

            }else{
                $this->vista("/defecto",$this->datos);
            }
                
        }
    }
?>