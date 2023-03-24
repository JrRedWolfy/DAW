<?php
    class PrestamoModelo{
        private $db;

        public function __construct(){
            $this->db = new Base;
        }

        //Funciones de Prestamo
        
        public function get_prestamos(){
            $this->db->query("SELECT p.Id_Prestamo, est.Nombre as NombreEst, tipo.Nombre as NombreTipo, pers.Nombre as NombrePers, p.Fecha_Fin, p.Importe
                                FROM PRESTAMO p, PERSONA pers, TIPO_PRESTAMO tipo, ESTADO est
                            WHERE pers.Id_Persona=p.Id_Persona AND tipo.Id_TipoPrestamo=p.Id_TipoPrestamo AND est.Id_Estado=p.Id_Estado");

            return $this->db->registros();

        }

        public function get_prestamo($id){
            $this->db->query("SELECT p.Id_Prestamo as Id, est.Nombre as NombreEst, tipo.Nombre as NombreTipo, pers.Nombre as NombrePers, p.Fecha_Fin, p.Importe as Importe
                                FROM PRESTAMO p, PERSONA pers, TIPO_PRESTAMO tipo, ESTADO est
                                WHERE pers.Id_Persona=p.Id_Persona AND tipo.Id_TipoPrestamo=p.Id_TipoPrestamo AND est.Id_Estado=p.Id_Estado AND p.Id_Prestamo = :id");

                $this->db->bind(':id',$id);

            return $this->db->registro();


        }

        public function get_abonos($id){


            $this->db->query("SELECT Id_Abono as Id, Id_Prestamo as Prestamo, Fecha, Cantidad
                                FROM ABONO
                                WHERE Id_Prestamo = :id");

                $this->db->bind(':id',$id);

            return $this->db->registros();

        }

        public function add_abono($abono, $resto){

            $this->db->query("INSERT INTO MOVIMIENTO (Fecha, Procedencia, Cantidad, Id_TipoMov)
                VALUES (NOW(), :texto, :importe, 1)");

                $this->db->bind(':texto', "Abono Receibido: #".trim($abono['id_prestamo']));
                $this->db->bind(':importe',trim($abono['importe']));

            $id_move = $this->db->executeLastId();
               
                if ($abono['importe'] == $resto){
                    $this->db->query("UPDATE PRESTAMO SET Id_Estado='2' WHERE Id_Prestamo=:id_prestamo");

                    $this->db->bind(':id_prestamo', $abono['id_prestamo']);

                    $this->db->execute();
                }

                $this->db->query("INSERT INTO ABONO (Id_Prestamo, Fecha, Cantidad, Id_Movimiento)
                VALUES (:id, NOW(), :cantidad, :movimiento)");

                $this->db->bind(':id',trim($abono['id_prestamo']));
                $this->db->bind(':cantidad',trim($abono['importe']));
                $this->db->bind(':movimiento', $id_move);
        
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }

        }

        public function addPrestamo($datos){

            $this->db->query("INSERT INTO PRESTAMO (Concepto, Importe, Observaciones, Fecha_Fin, Fecha_Inicio, Id_Persona, Id_TipoPrestamo, Id_Estado)
                VALUES (:concepto, :importe, :observaciones, :fecha_fin, NOW(), :Id_Persona, :Id_TipoPrestamo, 1)");

                $this->db->bind(':concepto',trim($datos['concepto']));
                $this->db->bind(':importe',trim($datos['importe']));
                $this->db->bind(':observaciones',trim($datos['observaciones']));
                $this->db->bind(':fecha_fin',trim($datos['fecha_fin']));
                $this->db->bind(':Id_Persona',trim($datos['Id_Persona']));
                $this->db->bind(':Id_TipoPrestamo',trim($datos['Id_TipoPrestamo']));
               
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

        public function getestado(){
            $this->db->query("SELECT * FROM ESTADO");

            return $this->db->registro();
        }

        public function get_estados(){
            $this->db->query("SELECT Id_Estado as Id, Nombre as Nombre FROM ESTADO WHERE Id_Estado != 3 AND Id_Estado != 4");

            return $this->db->registros();
        }

        public function aprobarEstado($id_prestamo){


            // $this->db->query("INSERT INTO MOVIMIENTO (Fecha, Procedencia, Cantidad, Id_TipoMov)
            //     VALUES (NOW(), :texto, :importe, 2)");

            //     $this->db->bind(':texto', "Prestamo Concedido a: #".trim($datos['Id_Persona']));
            //     $this->db->bind(':importe',trim($datos['importe']));

            // $id_movimiento = $this->db->executeLastId();


            $this->db->query("UPDATE PRESTAMO SET Id_Estado='5' WHERE Id_Prestamo=:id_prestamoA");

            $this->db->bind(':id_prestamoA', $id_prestamo);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }

        }

        public function rechazarEstado($id_prestamo){
            $this->db->query("UPDATE PRESTAMO SET Id_Estado='6' WHERE Id_Prestamo=:id_prestamo");

            $this->db->bind(':id_prestamo', $id_prestamo);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }

        }

    }

?>