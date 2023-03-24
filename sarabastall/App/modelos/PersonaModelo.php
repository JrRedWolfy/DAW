<?php
    class PersonaModelo{
        private $db;

        public function __construct(){
            $this->db = new Base;
        }

        //Funciones de Persona

        public function get_roles(){
            $this->db->query("SELECT Id_Rol as Id, Nombre_Rol as Nombre FROM ROL");

            return $this->db->registros();
        }

        public function get_profesores(){
            $this->db->query("SELECT p.Id_Persona as Id, Nombre FROM PERSONA p
            WHERE p.Id_Rol = 5");

            return $this->db->registros();
        }

        public function get_personas(){

            $this->db->query("SELECT pers.Id_Persona as Id_Persona, r.Nombre_Rol as Nombre_Rol, pers.Nombre as Nombre, pers.Apellidos as Apellidos,
            pers.Direccion as Direccion, pers.Fecha_Nacimiento as Fecha_Nacimiento, pers.Telefono as Telefono,
            pers.Email as Email, pers.Login as Login
            FROM PERSONA pers, ROL r
            WHERE r.Id_Rol = pers.Id_Rol AND pers.Id_Estado != 4");

            return $this->db->registros();

        }

        public function addPersona($datos){
            $this->db->query("INSERT INTO PERSONA (Nombre, Apellidos, Direccion, Genero, Fecha_Nacimiento, Telefono, Email, Id_Rol, Id_Estado)
                VALUES (:nombrePersona, :apellidosPersona, :direccionPersona, :genero, :fechaNacimientoPersona, :telefonoPersona, :emailPersona, 6, 3)"); // CAMBIAR El ROL Por el que sea No Log

                $this->db->bind(':nombrePersona',trim($datos['nombrePersona']));
                $this->db->bind(':apellidosPersona',trim($datos['apellidosPersona']));
                $this->db->bind(':genero',trim($datos['genero']));
                $this->db->bind(':direccionPersona',trim($datos['direccionPersona']));
                $this->db->bind(':fechaNacimientoPersona',trim($datos['fechaNacimientoPersona']));
                $this->db->bind(':telefonoPersona',trim($datos['telefonoPersona']));
                $this->db->bind(':emailPersona',trim($datos['emailPersona']));
                // $this->db->bind(':loginPersona',trim($datos['loginPersona']));

               
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
            
        }

        public function eliminarPersona($id_persona){
            // Funcion para eliminar una persona
            $this->db->query("UPDATE PERSONA SET Id_Estado= 4 WHERE Id_Persona=:Id_Persona");
            
            $this->db->bind(':Id_Persona', $id_persona);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
            
        }

        public function new_usuario($datos){
            // Funcion para asignar un usuario

            $this->db->query("UPDATE PERSONA SET Login= :user, Password= SHA2(:clave, 256), Id_Rol = :rol WHERE Id_Persona=:Id"); // SHA2 da error
            
            $this->db->bind(':user', $datos["usuario"]);
            $this->db->bind(':clave', $datos["clave"]);
            $this->db->bind(':rol', $datos["rol"]);
            $this->db->bind(':Id', $datos["id_user"]);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
            
        }

        public function getVisualizarPersona($id_persona){
            $this->db->query("SELECT * FROM PERSONA
                                WHERE Id_Persona=:id_persona");


            $this->db->bind(':id_persona', $id_persona);
            

            return $this->db->registro();
        }

        public function editPersona($datos, $id_persona){ 

            $this->db->query("UPDATE PERSONA SET Nombre=:nombre_persona, Apellidos=:apellido_persona, Direccion=:direccion_persona, Fecha_Nacimiento=:fecha_nacimiento_persona,
                                                    telefono=:telefono_persona, Email=:email_persona, Login=:login_persona
                                WHERE Id_Persona=:id_persona");

            $this->db->bind(':nombre_persona', $datos['nombre_persona']);
            $this->db->bind(':apellido_persona', $datos['apellido_persona']);
            $this->db->bind(':direccion_persona', $datos['direccion_persona']);
            $this->db->bind(':fecha_nacimiento_persona', $datos['fecha_nacimiento_persona']);
            $this->db->bind(':telefono_persona', $datos['telefono_persona']);
            $this->db->bind(':email_persona', $datos['email_persona']);
            $this->db->bind(':login_persona', $datos['login_persona']);
            $this->db->bind(':id_persona', $id_persona);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function get_alumnos(){
            $this->db->query("SELECT pers.Id_Persona as Id_Persona, pers.Nombre as Nombre, pers.Apellidos as Apellidos,
            pers.Direccion as Direccion, pers.Fecha_Nacimiento as Fecha_Nacimiento, a.Curso_Actual as Curso, a.Tutor_Legal as Tutor
            FROM PERSONA pers, ALUMNO a
            WHERE a.Id_Persona=pers.Id_Persona AND pers.Id_Estado != 4");

            return $this->db->registros();
        }


        //AÑADIR ALUMNO
        public function add_alumno($datos){
            $this->db->query("INSERT INTO PERSONA (Nombre, Apellidos, Direccion, Genero, Fecha_Nacimiento, Id_Rol, Id_Estado)
                VALUES (:nombrePersona, :apellidosPersona, :direccionPersona, :genero, :fechaNacimientoPersona, 6, 3)"); // CAMBIAR El ROL Por el que sea No Log

                $this->db->bind(':nombrePersona',trim($datos['nombrePersona']));
                $this->db->bind(':apellidosPersona',trim($datos['apellidosPersona']));
                $this->db->bind(':genero',trim($datos['genero']));
                $this->db->bind(':direccionPersona',trim($datos['direccionPersona']));
                $this->db->bind(':fechaNacimientoPersona',trim($datos['fechaNacimientoPersona']));


            $id_persona = $this->db->executeLastId();

            $this->db->query("INSERT INTO ALUMNO (Id_Persona, Curso_Actual, Tutor_Legal)
                VALUES (:id, :cursoActual, :tutorLegal)");

                $this->db->bind(':id',$id_persona);
                $this->db->bind(':cursoActual',trim($datos['cursoActual']));
                $this->db->bind(':tutorLegal',trim($datos['tutorLegal']));

                            
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
            
        }

    }

?>