<?php
    class Profesor extends Controlador{

        public function __construct(){

            Sesion::iniciarSesion($this->datos);

            $this->cursoModelo = $this->modelo('CursoModelo');
            $this->personaModelo = $this->modelo('PersonaModelo');

            $this->datos["controlador"] = "profesor";
            $this->datos["rolesPermitidos"] = [5];

            if(!tienePrivilegios($this->datos["usuarioSesion"]->Id_Rol, $this->datos["rolesPermitidos"])){
                exit();
            }

        }
        
        public function index(){
            $this->datos["CursosTotales"] = $this->cursoModelo->get_cursos();
            $this->datos["especialidades"] = $this->cursoModelo->get_especialidades();

            $this->vista("gestion/cursos",$this->datos);
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
                        $data = $this->cursoModelo->get_Cursos();
                        break;
                }
                $this->vistaApi($data);
            }
        }   
        
        public function add_material($id){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $material = $_POST;
                if($this->cursoModelo->add_Material($material)){
                    redireccionar("/profesor/see_curso/$id");
                }else{
                    echo "Se ha producido un error";
                }
            }else{   
            } 
        }

        public function del_material($id_curso, $id_material){
            if($this->cursoModelo->del_Material($id_curso, $id_material)){
                redireccionar("/profesor/see_curso/$id_curso");
            }else{
                echo "Se ha producido un error";
            }
        }
        
        public function see_curso($id_curso){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $curso=$_POST;
                if($this->cursoModelo->mod_curso($curso, $id_curso)){
                    redireccionar("/profesor/see_curso/$id_curso");
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

        public function add_curso(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $curso = $_POST;
                $id = $this->datos["usuarioSesion"]->Id_Persona;
    
                if($this->cursoModelo->add_Curso_Profe($curso, $id)){
                    redireccionar("/profesor/gestionar_cursos");
                }else{
                    echo "Se ha producido un error";
                }
            }else{
            } 
        }

        public function del_curso(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $id_curso = $_POST["id_curso"];
                $id = $this->datos["usuarioSesion"]->Id_Rol;
    
                if($this->cursoModelo->del_Curso($id_curso, $id)){
                    redireccionar("/profesor/gestionar_cursos");
                }else{
                    echo "Se ha producido un error";
                }
    
            }else{
    
            } 
        }


    }
?>