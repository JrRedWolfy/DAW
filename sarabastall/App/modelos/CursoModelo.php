<?php
    class CursoModelo{
        private $db;

        public function __construct(){
            $this->db = new Base;
        }

        // EN FUNCIONAMIENTO
        public function get_Curso($id_curso){
            //Devuelve la informacion de un Curso concreto

            $this->db->query("SELECT e.Nombre as Especialidad, c.Id_Curso as Id, c.Nombre as Curso, p.Nombre as Profesor, c.Fecha_Impartir as Fecha FROM CURSO c, PERSONA p, ESPECIALIDAD e
            WHERE c.Id_Persona = p.Id_Persona AND c.Id_Especialidad = e.Id_Especialidad AND c.Id_Curso = :id
            ORDER BY c.Nombre DESC");

            $this->db->bind(':id', $id_curso);

            return $this->db->registro();
        }

        // EN FUNCIONAMIENTO
        public function get_Cursos_trabajador($id){
            // Devuelve toda la informacion de los cursos ha insertar en las tablas

            $this->db->query("SELECT c.Id_Curso as Id_Curso, e.Nombre as Especialidad, c.Nombre as Nombre, p.Nombre as Profesor, c.Fecha_Impartir as Fecha, COALESCE(r.Id_Persona, 'No') as Apuntado 
                            FROM ESPECIALIDAD e, PERSONA p, RECIBIR r RIGHT JOIN CURSO c ON r.Id_Curso = c.Id_Curso AND r.Id_Persona = :id
                            WHERE c.Id_Especialidad = e.Id_Especialidad AND c.Id_Persona = p.Id_Persona 
                            ORDER BY c.Nombre DESC;");

                $this->db->bind(':id', $id);

            return $this->db->registros();
        }

        public function get_participacion($id) {
            $this->db->query("SELECT p.Id_Persona as Id, p.Nombre as Nombre, p.Apellidos as Apellidos, p.Genero as Genero, r.Fecha as Fecha
            FROM PERSONA p, RECIBIR r
            WHERE r.Id_Curso = :id AND p.Id_Persona = r.Id_Persona
            ORDER BY p.Nombre DESC");

            $this->db->bind(':id', $id);

            return $this->db->registros();

        }

        // EN FUNCIONAMIENTO
        public function get_Cursos(){
            // Devuelve toda la informacion de los cursos ha insertar en las tablas

            $this->db->query("SELECT c.Id_Curso as Id_Curso, e.Nombre as Especialidad, c.Nombre as Nombre, p.Nombre as Profesor, c.Fecha_Impartir as Fecha FROM CURSO c, PERSONA p, ESPECIALIDAD e
            WHERE c.Id_Persona = p.Id_Persona AND c.Id_Especialidad = e.Id_Especialidad AND c.Id_Estado != 4
            ORDER BY c.Nombre DESC");

            return $this->db->registros();
        }

        public function get_Realizados($id){
            // Devuelve toda la informacion de los cursos ha insertar en las tablas

            $this->db->query("SELECT c.Id_Curso as Id_Curso, e.Nombre as Especialidad, c.Nombre as Nombre, p.Nombre as Profesor, c.Fecha_Impartir as Fecha 
            FROM CURSO c, PERSONA p, ESPECIALIDAD e, RECIBIR r
            WHERE c.Id_Persona = p.Id_Persona AND c.Id_Especialidad = e.Id_Especialidad AND r.Id_Curso = c.Id_Curso AND r.Id_Persona = :id AND c.Fecha_Impartir < CURDATE()
            ORDER BY c.Nombre DESC");

            $this->db->bind(':id', $id);

            return $this->db->registros();
        }

        public function get_Apuntado($id){
            // Devuelve toda la informacion de los cursos ha insertar en las tablas

            $this->db->query("SELECT c.Id_Curso as Id_Curso, e.Nombre as Especialidad, c.Nombre as Nombre, p.Nombre as Profesor, c.Fecha_Impartir as Fecha 
            FROM CURSO c, PERSONA p, ESPECIALIDAD e, RECIBIR r
            WHERE c.Id_Persona = p.Id_Persona AND c.Id_Especialidad = e.Id_Especialidad AND r.Id_Curso = c.Id_Curso AND r.Id_Persona = :id AND c.Fecha_Impartir >= CURDATE()
            ORDER BY c.Nombre DESC");

            $this->db->bind(':id', $id);

            return $this->db->registros();
        }

        public function get_Aviables(){
            // Devuelve toda la informacion de los cursos ha insertar en las tablas

            $this->db->query("SELECT c.Id_Curso as Id_Curso, e.Nombre as Especialidad, c.Nombre as Nombre, p.Nombre as Profesor, c.Fecha_Impartir as Fecha 
            FROM CURSO c, PERSONA p, ESPECIALIDAD e, RECIBIR r
            WHERE c.Id_Persona = p.Id_Persona AND c.Id_Especialidad = e.Id_Especialidad AND r.Id_Curso = c.Id_Curso AND c.Fecha_Impartir >= CURDATE()
            ORDER BY c.Nombre DESC");

            return $this->db->registros();
        }

        // EN FUNCIONAMIENTO
        public function get_Cursos_Disponibles(){
            // Personalmente intentaria emular la funcionalidad de los Cursos como se hace en el moddle,
            // puesto que con la fecha deja mucho que desear, cuando empieza el curso, cuando acaba, dura un solo dia?

            $this->db->query("SELECT c.Id_Curso, c.Nombre, p.Nombre, c.Fecha_Impartir FROM CURSO c, PERSONA p
            WHERE c.Id_Persona = p.Id_Persona AND c.Fecha_Impartir > CURDATE()
            ORDER BY c.Nombre ASC");

            return $this->db->registros();
        }

        

        // EN FUNCIONAMIENTO
        public function add_Curso_Profe($datos, $id){

            $this->db->query("INSERT INTO CURSO (Nombre, Importe, Fecha_Impartir, Id_Persona, Id_Especialidad, Id_Movimiento, Id_estado)
            VALUES (:nombre, null, :fecha, :profesor, :especialidad, null, 1)");
            $this->db->bind(':nombre',trim($datos['nombre']));
            $this->db->bind(':fecha',trim($datos['fecha']));
            $this->db->bind(':profesor', $id);
            $this->db->bind(':especialidad',trim($datos['tipo']));


            if($this->db->execute()){
                return true;
            }else{
                return false;
            }

        }

        // EN FUNCIONAMIENTO
        public function del_Curso($id_curso){
            // Funcion para eliminar un curso

            $this->db->query("UPDATE CURSO SET Id_Estado= 4 WHERE Id_Curso=:id_curso");
            
            // $this->db->bind(':Id_Persona', $id_persona);
            
            // $this->db->query("DELETE FROM CURSO WHERE Id_Curso = :id_curso");
            
            $this->db->bind(':id_curso', $id_curso);

            if($this->db->execute()){
                return true; // OBSERVACION; Puede que borrar un curso no sea buena idea si eso conlleva eliminar los movimientos asociados.
            }else{
                return false;
            }
        }

        // EN FUNCIONAAMIENTO
        public function mod_Curso($curso, $id_curso){

            // Meditar si un curso creado puede ser modificado para añadir un importe o modificarlo

            $this->db->query("UPDATE CURSO SET Nombre=:nombre, Fecha_Impartir=:fecha, Id_Persona= :profesor, Id_Especialidad=:especialidad
            WHERE Id_Curso=:id_curso");

            $this->db->bind(':nombre', $curso['nombre']);
            $this->db->bind(':profesor', $curso['profesor']);
            $this->db->bind(':fecha', $curso['fecha']);
            $this->db->bind(':especialidad', $curso['tipo']);
            
            $this->db->bind(':id_curso', $id_curso);

            if($this->db->execute()){
            return true;
            }else{
            return false;
            }
        
        }

        // EN FUNCIONAMIENTO
        public function get_Material($id_curso){
            // Devuelve toda la informacion del Material asociado a un Curso

            $this->db->query("SELECT m.Id_Material as Id, m.Nombre as Nombre, Archivo FROM POSEER p, MATERIAL m
            WHERE p.Id_Material = m.Id_Material AND p.Id_Curso = :id");

            $this->db->bind(':id', $id_curso);

            return $this->db->registros();
        }


        public function add_Material($datos){

            $this->db->query("INSERT INTO MATERIAL (Nombre, Archivo)
                VALUES (:nombre, null)");

                $this->db->bind(':nombre', trim($datos['nombre']));

                $id_movimiento = $this->db->executeLastId();


            $this->db->query("INSERT INTO POSEER (Id_Material, Id_Curso)
                VALUES (:material, :curso)");

                $this->db->bind(':material', $id_movimiento);
                $this->db->bind(':curso', trim($datos['id_curso']));

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
            
        }

        public function mod_Material($datos){
            // Cambiamos estado asesoria = 2 -Procesando-
            $this->db->query("UPDATE asesoria SET id_estado=2 WHERE id_asesoria=:id_asesoria");

            $this->db->bind(':id_asesoria', $datos['id_asesoria']);
            
            $this->db->execute();

            $this->db->query("INSERT INTO reg_acciones (fecha_reg, accion, automatica, id_asesoria, id_profesor)
                                        VALUES (NOW(), :accion, 0, :id_asesoria, :id_profesor)");
            
            $this->db->bind(':id_asesoria', $datos['id_asesoria']);
            $this->db->bind(':id_profesor', $datos['id_profesor']);
            $this->db->bind(':accion', $datos['accion']);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
            
        }

        // EN FUNCIONAMIENTO
        public function del_Material($id_curso, $id_material){
            // Cambiamos estado asesoria = 2 -Procesando-
            $this->db->query("DELETE FROM POSEER WHERE Id_Curso = :curso AND Id_Material = :material");

            $this->db->bind(':curso', $id_curso);
            $this->db->bind(':material', $id_material);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
            
        }

        // EN FUNCIONAMIENTO
        public function get_Especialidades(){
            // Devuelve toda la informacion del Material asociado a un Curso

            $this->db->query("SELECT Id_Especialidad as Id, Nombre FROM ESPECIALIDAD");

            return $this->db->registros();
        }

        public function join_curso($id_curso, $id_trabajador){

            $this->db->query("INSERT INTO RECIBIR (Id_Curso, Id_Persona, Fecha) 
                VALUES (:id_curso, :id_trabajador, NOW())");

                $this->db->bind(':id_trabajador', $id_trabajador);
                $this->db->bind(':id_curso', $id_curso);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }

        }

        // Funciones individuales por Especialidad??
        // Consultar


    }

?>