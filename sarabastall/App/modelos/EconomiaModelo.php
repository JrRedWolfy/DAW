<?php
    class EconomiaModelo{
        private $db;

        public function __construct(){
            $this->db = new Base;
        }

        //Funciones de Movimientos

        public function get_movimientos(){
            $this->db->query("SELECT m.Id_Movimiento as Id_Movimiento, tm.Nombre_TipoMov as Nombre_TipoMov, m.Procedencia as Procedencia, m.Fecha as Fecha, m.Cantidad as Cantidad, 
                                m.Id_Beca as Id_Beca FROM MOVIMIENTO m, TIPO_MOVIMIENTO tm
                                WHERE m.Id_TipoMov = tm.Id_TipoMov");
            return $this->db->registros();
        }

        public function get_tipos_movimiento(){

            $this->db->query("SELECT Id_TipoMov as Id, Nombre_TipoMov as Nombre FROM TIPO_MOVIMIENTO");
            return $this->db->registros();
            
        }

        public  function get_tipoMov(){
            $this->db->query("SELECT * FROM TIPO_MOVIMIENTO");
            
            return $this->db->registros();
        }

        public function get_tipoBeca(){
            $this->db->query("SELECT Id_Beca, Importe FROM BECA");

            return $this->db->registros();
        }

        //Si se selecciona una beca vacia, que en la base de datos se añada como null
        public function add_movimiento($datos){
            print_r($datos);

            
    
            if($datos["selectBeca"]==""){
                
                $this->db->query("INSERT INTO MOVIMIENTO (Fecha, Procedencia, Cantidad, Id_TipoMov) VALUES (:Fecha, :Procedencia, :Cantidad, :Id_TipoMov)");

                $this->db->bind(':Fecha',trim($datos['fecha']));
                $this->db->bind(':Procedencia', trim($datos['concepto']));
                $this->db->bind(':Cantidad',trim($datos['cuantia']));
                $this->db->bind(':Id_TipoMov', trim($datos['selectMovimiento']));
            }else{
                
                $this->db->query("INSERT INTO MOVIMIENTO (Fecha, Procedencia, Cantidad, Id_TipoMov, Id_Beca) VALUES (:Fecha, :Procedencia, :Cantidad, :Id_TipoMov, :Id_Beca)");

                $this->db->bind(':Fecha',trim($datos['fecha']));
                $this->db->bind(':Procedencia', trim($datos['concepto']));
                $this->db->bind(':Cantidad',trim($datos['cuantia']));
                $this->db->bind(':Id_TipoMov', trim($datos['selectMovimiento']));
                $this->db->bind(':Id_Beca', trim($datos['selectBeca']));
   
                
            }

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        
        }

    }
?>
