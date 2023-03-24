<?php
    class PedirConsultarPrestamo{
        private $db;

        public function __construct(){
            $this->db = new Base;
        }

        //Funciones de Prestamo

        public function get_prestamos(){
            $this->db->query("SELECT p.Id_Prestamo, p.Concepto, p.Importe, est.Id_Estado, est.Nombre as NombreEst, p.Fecha_Inicio, pers.Nombre as NombrePers, tipo.Nombre as NombreTipo 
                                FROM PRESTAMO p, PERSONA pers, TIPO_PRESTAMO tipo, ESTADO est
                            WHERE pers.Id_Persona=p.Id_Persona AND tipo.Id_TipoPrestamo=p.Id_TipoPrestamo AND est.Id_Estado=p.Id_Estado");

            return $this->db->registros();

        }

        public function get_prestamos_usuario($id){

            $this->db->query("SELECT p.Id_Prestamo, est.Nombre as NombreEst, tipo.Nombre as NombreTipo, pers.Nombre as NombrePers, p.Fecha_Fin, p.Importe
                                FROM PRESTAMO p, PERSONA pers, TIPO_PRESTAMO tipo, ESTADO est
                                WHERE pers.Id_Persona=p.Id_Persona AND tipo.Id_TipoPrestamo=p.Id_TipoPrestamo AND est.Id_Estado=p.Id_Estado AND :id=p.Id_Persona");

            $this->db->bind(':id',$id);

            return $this->db->registros();

        }

       

        public function addPrestamoNombre($datos,$id){
            $this->db->query("INSERT INTO PRESTAMO (Concepto, Importe, Observaciones, Fecha_Inicio, fecha_fin, Id_Persona, Id_TipoPrestamo, Id_Estado)
                VALUES (:concepto, :importe, :observaciones, NOW(), :fecha_fin, :Id_Persona, :Id_TipoPrestamo, 1)");

                    $this->db->bind(':concepto',trim($datos['concepto']));
                    $this->db->bind(':importe',trim($datos['importe']));
                    $this->db->bind(':observaciones',trim($datos['observaciones']));
                    $this->db->bind(':fecha_fin',trim($datos['fecha_fin']));
                    $this->db->bind(':Id_Persona',trim($datos['Id_Persona']));
                    $this->db->bind(':Id_TipoPrestamo',trim($datos['Id_TipoPrestamo']));
                
                $this->db->bind(':Id_Persona',$id);

                print_r($id);

               
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
            
        }


        public function getpersonaPrestamo(){
            $this->db->query("SELECT p.Id_Persona as Id_Persona, p.Nombre as Nombre FROM PERSONA p");

            return $this->db->registros();
        }
        
        public function gettipoPrestamo(){
            $this->db->query("SELECT * FROM TIPO_PRESTAMO");

            return $this->db->registros();
        }

        public function get_estados(){
            $this->db->query("SELECT Id_Estado as Id, Nombre as Nombre FROM ESTADO WHERE Id_Estado != 3 AND Id_Estado != 4");

            return $this->db->registros();
        }

    }

?>