<?php
    class Admin extends Controlador{

        public function __construct(){

            Sesion::iniciarSesion($this->datos);

            //$this->datos["usuarioSesion"] = $this->asesoriaModelo->getPersona(1);
            $this->cursoModelo = $this->modelo('CursoModelo');
            $this->centroModelo = $this->modelo('CentroModelo');
            $this->prestamoModelo = $this->modelo('PrestamoModelo');
            $this->becaModelo = $this->modelo('BecaModelo');
            $this->economiaModelo = $this->modelo('EconomiaModelo');
            $this->personaModelo = $this->modelo('PersonaModelo');

            $this->datos["controlador"] = "admin";
            $this->datos["rolesPermitidos"] = [1];

            if(!tienePrivilegios($this->datos["usuarioSesion"]->Id_Rol, $this->datos["rolesPermitidos"])){
                exit();
            }

        }
        
        public function index(){

            $this->vista("menu",$this->datos);

        }

        public function gestionar_centros(){

            $this->datos["centros"] = $this->centroModelo->get_centros();
            $this->datos["ciudades"] = $this->centroModelo->get_ciudades();

            $this->vista("gestion/centros",$this->datos);
        }

        public function gestionar_prestamos(){

            $this->datos["PrestamosTotales"] = $this->prestamoModelo->get_prestamos();

            $this->datos["nombrepersona"] = $this->prestamoModelo->getpersonaPrestamo();

            $this->datos["tipoprestamo"] = $this->prestamoModelo->gettipoPrestamo();
            
            $this->datos["estado"] = $this->prestamoModelo->getestado();
            $this->datos["estados"] = $this->prestamoModelo->get_estados();
            
            $this->vista("gestion/prestamos",$this->datos);
        }

        public function gestionar_cursos(){


            //$this->datos["pageInfo"] = $_COOKIE["pageInfo"];
            $this->datos["CursosTotales"] = $this->cursoModelo->get_Cursos();
            $this->datos["especialidades"] = $this->cursoModelo->get_especialidades();
            $this->datos["profesores"] = $this->personaModelo->get_profesores();

            $this->vista("gestion/cursos",$this->datos);
        }

        public function gestionar_personas(){

            $this->datos["PersonasTotales"] = $this->personaModelo->get_personas();
            $this->datos["roles"] = $this->personaModelo->get_roles();
            
            $this->vista("gestion/personas",$this->datos);
        }

        public function gestionar_becas(){

            $this->datos["BecasTotales"] = $this->becaModelo->get_becas();

            $this->datos["nombrealumno"] = $this->becaModelo->getalumnoBeca();

            $this->datos["tipos"] = $this->becaModelo->get_tipos();
            $this->datos["tipobeca"] = $this->becaModelo->getTipoBeca();

            $this->datos["ciudades"] = $this->becaModelo->getCiudades();



            $this->vista("gestion/becas",$this->datos);
        }

        public function gestionar_economia(){
            
           $this->datos["MovimientosTotales"] = $this->economiaModelo->get_movimientos();
           $this->datos["tipoBeca"] = $this->economiaModelo->get_tipoBeca();
           $this->datos["tipos_movimiento"] = $this->economiaModelo->get_tipos_movimiento();
           $this->vista("gestion/economia",$this->datos);
        }

        //Gestion Economia
        public function add_movimiento(){
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                $movimiento = $_POST;
                print_r($movimiento);
                if(!$_POST['concepto'] && !$_POST['fecha'] && !$_POST['cuantia']){
                        // redireccionar('/admin/gestionar_economia');
                }else{   
                    if($this->economiaModelo->add_movimiento($movimiento)){
                        redireccionar('/admin/gestionar_economia');
                    }else{
                        echo "Se ha producido un error";
                    }
                }
            }else{
                $this->vista("/admin",$this->datos);
            }  
        }

        //Gestión cursos
        public function see_curso($id_curso){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $curso=$_POST;
                if($this->cursoModelo->mod_curso($curso, $id_curso)){
                    redireccionar("/admin/see_curso/$id_curso");
                } else{
                    echo "¡¡Se ha producido un error!!";
                }
            }else{
                $this->datos["curso"]=$this->cursoModelo->get_curso($id_curso);
                $this->datos["curso"]->material = $this->cursoModelo->get_material($id_curso);
                $this->datos["curso"]->participante = $this->cursoModelo->get_participacion($id_curso);
                $this->datos["especialidades"] = $this->cursoModelo->get_especialidades();
                $this->datos["profesores"] = $this->personaModelo->get_profesores();
    
                $this->vista("gestion/ver_curso",$this->datos);
            }
        }

        public function del_curso(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $id_curso = $_POST["id_curso"];
                $id = $this->datos["usuarioSesion"]->Id_Rol;
    
                if($this->cursoModelo->del_Curso($id_curso, $id)){
                    redireccionar("/admin/gestionar_cursos");
                }else{
                    echo "Se ha producido un error";
                }
    
            }else{
    
            } 
        }

        public function del_material($id_curso, $id_material){
            if($this->cursoModelo->del_Material($id_curso, $id_material)){
                redireccionar("/admin/see_curso/$id_curso");
            }else{
                echo "Se ha producido un error";
            }
        }

        public function add_curso(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $curso = $_POST;
    
                if($this->cursoModelo->add_Curso($curso)){
                    redireccionar("/admin/gestionar_cursos");
                }else{
                    echo "Se ha producido un error";
                }
            }else{
            } 
        }

        public function add_material($id){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $material = $_POST;
                if($this->cursoModelo->add_Material($material)){
                    redireccionar("/admin/see_curso/$id");
                }else{
                    echo "Se ha producido un error";
                }
            }else{   
            } 
        }

        // Gestion Centro

        public function del_centro(){  
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $Id_Centro = $_POST["id_centro"];

                if($this->centroModelo->del_centro($Id_Centro)){
                    redireccionar("/admin/gestionar_centros");
                }else{
                    echo "Se ha producido un error";
                }
            }   
        }

        public function see_centro($Id_Centro){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $centro=$_POST;

                if($this->centroModelo->editCentro($centro, $Id_Centro)){
                    redireccionar("/admin/see_centro/$Id_Centro");
                }else{
                    echo "¡Se ha producido un error!";
                }

            }else{
                $this->datos["centro"] = $this->centroModelo->getVisualizarCentro($Id_Centro);

                $this->vista("gestion/ver_centro", $this->datos);
            }
        }

        public function add_centro(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $centro = $_POST;

                if($this->centroModelo->add_centro($centro)){
                    redireccionar("/admin/gestionar_centros");
                }else{
                    echo "Se ha producido un error";
                }
            }else{
            } 
        }

        public function add_ciudad(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $ciudad = $_POST;
                if($this->centroModelo->add_ciudad($ciudad)){
                    redireccionar("/admin/gestionar_centros");
                }else{
                    echo "Se ha producido un error";
                }
            }else{
            } 
        }

        //Gestión Personas

        public function add_persona(){
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                $persona = $_POST;
                if(!$_POST['nombrePersona'] && !$_POST['apellidosPersona'] && !$_POST['direccionPersona'] && !$_POST['fechaNacimientoPersona'] && !$_POST['telefonoPersona'] && !$_POST['emailPersona'] ){
                    //  redireccionar('/admin/gestionar_personas');
                }else{   
                    if($this->personaModelo->addPersona($persona)){
                        redireccionar('/admin/gestionar_personas');
                    }else{
                        echo "Se ha producido un error";
                    }
                }
            }else{
                $this->vista("/admin",$this->datos);
            }   
        }

        public function del_persona(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $id_persona = $_POST["id_persona"];

                if($this->personaModelo->eliminarPersona($id_persona)){
                    redireccionar("/admin/gestionar_personas");
                }else{
                    echo "Se ha producido un error";
                }
            }else{
            } 
        }

        public function see_persona($id_persona){
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                $persona = $_POST;
    
                if($this->personaModelo->editPersona($persona, $id_persona)){
                    redireccionar("/admin/see_persona/$id_persona");
                }else {
                    echo "Se ha producido un error";
                }
            }else{
                $this->datos["persona"] = $this->personaModelo->getVisualizarPersona($id_persona);
                $this->vista("gestion/ver_persona",$this->datos);
            }
        }

        public function new_usuario(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $usuario = $_POST;
                if($this->personaModelo->new_usuario($usuario)){
                    redireccionar("/admin/gestionar_personas");
                }else{
                    echo "Se ha producido un error";
                }
            }else{
            } 
        }

        // Gestion Becas

        public function add_beca(){
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                $beca = $_POST;
                print_r($beca);

                if(!$_POST['Importe'] && !$_POST['Fecha_Beca']){
                    //   redireccionar('/admin/gestionar_personas');
                }else{   
                    if($this->becaModelo->addBeca($beca)){
                        redireccionar('/admin/gestionar_becas');
                    }else{
                        echo "Se ha producido un error";
                    }
                }
            }else{
                $this->vista("/admin",$this->datos);
            }     
        }

        // BECAS

        public function getCentros($id){
            $data = $this->becaModelo->getCentros($id);
            $this->vistaApi($data);
        }

        // Gestion Prestamos

        public function add_prestamo(){
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                $prestamo = $_POST;

                if(!$_POST['concepto'] && !$_POST['importe'] && !$_POST['estado'] && !$_POST['fecha_fin'] && !$_POST['Id_Persona'] && !$_POST['Id_TipoPrestamo']){
                    //  redireccionar('/admin/gestionar_personas');
                }else{   
                    if($this->prestamoModelo->addPrestamo($prestamo)){
                        redireccionar('/admin/gestionar_prestamos');
                    }else{
                        echo "Se ha producido un error";
                    }
                }
            }else{
                $this->vista("/admin",$this->datos);
            }    
        }

        public function pedir_prestamo(){
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                $prestamo = $_POST;
                print_r($prestamo);

                if(!$_POST['concepto'] && !$_POST['importe'] && !$_POST['fecha_inicio'] && !$_POST['Id_Persona'] && !$_POST['Id_TipoPrestamo']){
                    //  redireccionar('/admin/gestionar_personas');
                }else{   
                    if($this->pedirConsultarPrestamo->addPrestamo($prestamo)){
                        redireccionar('/admin/gestionar_economia');
                    }else{
                        echo "Se ha producido un error";
                    }
                }
            }else{
                $this->vista("/admin",$this->datos);
            }     
        }

        public function add_abono($id_prestamo, $resto = 0){
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                $prestamo = $_POST;
                if($this->prestamoModelo->add_abono($prestamo, $resto)){
                    redireccionar("/admin/add_abono/$id_prestamo");
                }else {
                    echo "Se ha producido un error";
                }
            }else{
                $this->datos["prestamo"] = $this->prestamoModelo->get_prestamo($id_prestamo);
                $this->datos["abonos"] = $this->prestamoModelo->get_abonos($id_prestamo);
                $this->vista("gestion/ver_abonos",$this->datos);
            }
        }
        
        public function aprobarEstado(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $id_prestamo = $_POST["id_prestamoA"];
    
                if($this->prestamoModelo->aprobarEstado($id_prestamo)){
                    redireccionar("/admin/gestionar_prestamos");
                }else{
                    echo "Se ha producido un error";
                }
            }else{
            } 
        }

        public function rechazarEstado(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $id_prestamo = $_POST["id_prestamo"];
                if($this->prestamoModelo->rechazarEstado($id_prestamo)){
                    redireccionar("/admin/gestionar_prestamos");
                }else{
                    echo "Se ha producido un error";
                }
            }else{
            } 
        }

    }

?>