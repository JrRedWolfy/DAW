<?php
    class Master extends Controlador{

        public function __construct(){

            Sesion::iniciarSesion($this->datos);

            //$this->datos["usuarioSesion"] = $this->asesoriaModelo->getPersona(1);

            $this->pedirConsultarPrestamo = $this->modelo('PedirConsultarPrestamo');
            $this->personaModelo = $this->modelo('PersonaModelo');
            $this->prestamoModelo = $this->modelo('PrestamoModelo');
            // $this->pedirConsultarPrestamo = $this->modelo('PedirConsultarPrestamo');

            $this->datos["controlador"] = "master";
            $this->datos["rolesPermitidos"] = [4];

            if(!tienePrivilegios($this->datos["usuarioSesion"]->Id_Rol, $this->datos["rolesPermitidos"])){
                exit();
            }

        }
        
        public function index(){

            $this->vista("menuMaster",$this->datos);

        }

        // public function gestionar_prestamo(){

        //     $this->datos["PrestamosTotales"] = $this->prestamoModelo->get_prestamos();
        //     $this->vista("gestion/prestamos",$this->datos);
        // }

        public function gestionar_persona(){

            $this->datos["PersonasTotales"] = $this->personaModelo->get_alumnos();
            $this->vista("gestion/personas",$this->datos);
        }

        // public function solicitar_prestamo(){

        //     $this->datos["tipoprestamo"] = $this->pedirConsultarPrestamo->gettipoPrestamo();

        //     $this->datos["nombrepersona"] = $this->pedirConsultarPrestamo->getpersonaPrestamo();


        //     $this->vista("gestion/prestamo/pedirPrestamoMaster",$this->datos);
        // }

        public function ver_prestamos(){

            $id = $this->datos["usuarioSesion"]->Id_Persona;
            $this->datos["tipoprestamo"] = $this->pedirConsultarPrestamo->gettipoPrestamo();
            $this->datos["estados"] = $this->pedirConsultarPrestamo->get_estados();
            $this->datos["PrestamosTotales"] = $this->pedirConsultarPrestamo->get_prestamos_usuario($id);
            $this->vista("gestion/prestamos",$this->datos);

        }

        //RELACIONADO CON PERSONA

        public function add_alumno(){
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                $persona = $_POST;
                //   print_r($persona);

                if(!$_POST['nombrePersona'] && !$_POST['apellidosPersona'] && !$_POST['direccionPersona'] && !$_POST['fechaNacimientoPersona'] && !$_POST['telefonoPersona'] ){
                    //  redireccionar('/master/gestionar_personas');
                }else{   
                    if($this->personaModelo->add_alumno($persona)){
                        redireccionar('/master/gestionar_persona');
                    }else{
                        echo "Se ha producido un error";
                }

                }

            }else{
                $this->vista("/master",$this->datos);
            }
                
        }


        public function eliminarPersona(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $id_persona = $_POST["id_persona"];
    
                if($this->personaModelo->eliminarPersona($id_persona)){
                    redireccionar("/master/gestionar_personas");
                }else{
                    echo "Se ha producido un error";
                }
    
            }else{
    
            } 
        }

        public function verPersona($id_persona){
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                $persona = $_POST;
    
                if($this->personaModelo->editPersona($persona, $id_persona)){
                    redireccionar("/master/verPersona/$id_persona");
                }else {
                    echo "Se ha producido un error";
                }
                
            }else{
                $this->datos["persona"] = $this->personaModelo->getVisualizarPersona($id_persona);
                $this->vista("gestion/personas/editarPersonaMaster",$this->datos);
            }
        }

        //REALCIONADO CON PRESTAMOS

        public function add_prestamo(){
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                $prestamo = $_POST;

                if(!$_POST['concepto'] && !$_POST['importe'] && !$_POST['fecha_inicio'] && !$_POST['Id_Persona'] && !$_POST['Id_TipoPrestamo']){
                     redireccionar('/master/gestionar_personas');
                }else{   
                    if($this->pedirConsultarPrestamo->addPrestamoNombre($prestamo, $this->datos["usuarioSesion"]->Id_Persona)){
                        redireccionar('/master/ver_prestamos');
                    }else{
                        echo "Se ha producido un error";
                    }
                }
            }else{
                $this->vista("/master",$this->datos);
            }
                
        }

        public function see_abono($id_prestamo, $resto = 0){
            $this->datos["prestamo"] = $this->prestamoModelo->get_prestamo($id_prestamo);
            $this->datos["abonos"] = $this->prestamoModelo->get_abonos($id_prestamo);
            $this->vista("gestion/ver_abonos",$this->datos);
        }



    }
?>