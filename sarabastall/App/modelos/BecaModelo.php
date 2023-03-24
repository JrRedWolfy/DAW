<?php
    class BecaModelo{
        private $db;

        public function __construct(){
            $this->db = new Base;
        }

        //Funciones de Beca

        public function get_becas(){
            $this->db->query("SELECT be.Id_Beca, ti.Tipo_Beca, alum.Tutor_Legal, pers.Nombre, be.Importe, be.Fecha_Beca FROM BECA be, TIPO_BECA ti, ALUMNO alum, PERSONA pers
                                WHERE ti.Id_Tipo_Beca=be.Id_Tipo_Beca AND alum.Id_Persona=be.Id_Persona AND pers.Id_Persona=be.Id_Persona");

            return $this->db->registros();

        }

        public function addBeca($datos){
            $this->db->query("INSERT INTO BECA (Importe, Observaciones, Fecha_Beca, Id_Persona, Id_Tipo_Beca, Id_Centro)
                VALUES (:Importe, :Observaciones, :Fecha_Beca, :Id_Persona, :Id_Tipo_Beca, :Id_Centro)");

                $this->db->bind(':Importe',trim($datos['Importe']));
                $this->db->bind(':Observaciones',trim($datos['Observaciones']));
                $this->db->bind(':Fecha_Beca',trim($datos['Fecha_Beca']));
                $this->db->bind(':Id_Persona',trim($datos['Id_Persona']));
                $this->db->bind(':Id_Tipo_Beca',trim($datos['Id_Tipo_Beca']));
                $this->db->bind(':Id_Centro',trim($datos['Id_Centro']));
                //Quedan Persona, centro y tipo de beca
                // $this->db->bind(':telefonoPersona',trim($datos['telefonoPersona']));
                // $this->db->bind(':emailPersona',trim($datos['emailPersona']));

               
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
            
        }

        public function getalumnoBeca(){
            $this->db->query("SELECT p.Id_Persona as Id_Persona, p.Nombre as Nombre, a.Tutor_Legal as Tutor_Legal FROM PERSONA p, ALUMNO a
                                WHERE p.Id_Persona= a.Id_Persona");

            return $this->db->registros();
        }

        public function getTipoBeca(){
            $this->db->query("SELECT * FROM TIPO_BECA");

            return $this->db->registros();
        }

        public function get_tipos(){
            $this->db->query("SELECT Id_Tipo_Beca as Id, Tipo_Beca as Nombre FROM TIPO_BECA");

            return $this->db->registros();
        }

        // public function getCentro(){
        //     $this->db->query("SELECT * FROM CENTRO WHERE Id_Estado != 4");

        //     return $this->db->registros();
        // }

        public function getCiudades(){
            $this->db->query("SELECT distinct c.Id_Ciudad, c.Nombre_Ciudad FROM CIUDAD c JOIN CENTRO n ON c.Id_Ciudad=n.Id_Ciudad");

            return $this->db->registros();
        }

        public function getCentros($id_ciudad){
            $this->db->query("SELECT cen.Id_Centro, cen.Nombre as Nombre_Ciudad, cen.Id_Ciudad as Id_Ciudad
                                FROM CENTRO cen WHERE :id_ciudad=cen.Id_Ciudad AND cen.Id_Estado != 4");

            $this->db->bind(':id_ciudad', $id_ciudad);

            return $this->db->registros();
        }

        
        // public function getVisualizarBeca($id_beca){
        //     $this->db->query("SELECT * FROM BECA
        //                         WHERE Id_Beca=:id_beca");


        //     $this->db->bind(':id_beca', $id_beca);
            

        //     return $this->db->registro();
        // }

    }

?>