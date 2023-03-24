<?php
    class Trabajador extends Controlador{

        public function __construct(){

            Sesion::iniciarSesion($this->datos);

            $this->pedirConsultarPrestamo = $this->modelo('PedirConsultarPrestamo');
            $this->cursoModelo = $this->modelo('CursoModelo');
            $this->prestamoModelo = $this->modelo('PrestamoModelo');

            $this->datos["controlador"] = "trabajador";
            $this->datos["rolesPermitidos"] = [2];

            if(!tienePrivilegios($this->datos["usuarioSesion"]->Id_Rol, $this->datos["rolesPermitidos"])){
                exit();
            }
        }
        
        public function index(){
            $this->vista("menuTrabajador",$this->datos);
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

        public function ver_cursos(){
            $id = $this->datos["usuarioSesion"]->Id_Persona;
            
            $this->datos["CursosTotales"] = $this->cursoModelo->get_Cursos_trabajador($id);

            
            $this->datos["especialidades"] = $this->cursoModelo->get_especialidades();
            $this->vista("gestion/cursos",$this->datos);
        }

        public function pedir_prestamo(){
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                $prestamo = $_POST;
                if(!$_POST['concepto'] && !$_POST['importe'] && !$_POST['fecha_fin']  && !$_POST['Id_TipoPrestamo']){
                    //  redireccionar('/admin/gestionar_personas');
                }else{   
                    if($this->pedirConsultarPrestamo->addPrestamoNombre($prestamo, $this->datos["usuarioSesion"]->Id_Persona)){
                        redireccionar('/trabajador');
                    }else{
                        echo "Se ha producido un error";
                    }
                }
            }else{
                $this->vista("/trabajador",$this->datos);
            }    
        }

        public function apuntarse_curso($id_curso){
            if($this->cursoModelo->join_curso($id_curso, $this->datos["usuarioSesion"]->Id_Persona)){
                redireccionar('/trabajador/ver_cursos');
            }else{
                echo "Se ha producido un error";
            }
        }

        public function agrupar_cursos($orden, $id){
            if($_SERVER['REQUEST_METHOD'] == 'GET'){
                switch ($orden){
                    case "aviable":
                        $data = $this->cursoModelo->get_Aviables();
                        break;

                    case "apuntado":
                        $data = $this->cursoModelo->get_Apuntado($id);
                        break;

                    case "completo":
                        $data = $this->cursoModelo->get_Realizados($id);
                        break;

                    default:
                        $data = $this->cursoModelo->get_Cursos_trabajador($id);
                        break;
                }
                $this->vistaApi($data);
            }
        }     

        public function see_abono($id_prestamo, $resto = 0){
            $this->datos["prestamo"] = $this->prestamoModelo->get_prestamo($id_prestamo);
            $this->datos["abonos"] = $this->prestamoModelo->get_abonos($id_prestamo);
            $this->vista("gestion/ver_abonos",$this->datos);
        }
    }
?>