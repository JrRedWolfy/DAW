<?php
    class CentroModelo{
        private $db;

        public function __construct(){
            $this->db = new Base;
        }

        //Funciones de Centro

        public function get_centros(){

            $this->db->query("SELECT cen.Id_Centro as Id_Centro, ciu.Nombre_Ciudad as Nombre_Ciudad, cen.Nombre as Nombre,  cen.Cuantia as Cuantia, ciu.Distancia as Distancia FROM CENTRO cen, CIUDAD ciu
                WHERE ciu.Id_Ciudad = cen.Id_Ciudad AND cen.Id_Estado != 4");

            return $this->db->registros();
        }


        public function del_centro($Id_Centro){

            $this->db->query("UPDATE CENTRO SET Id_Estado= 4 WHERE Id_Centro=:Id_Centro");
            
            $this->db->bind(':Id_Centro', $Id_Centro);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function add_centro($datos){
            $this->db->query("INSERT INTO CENTRO (Nombre, Cuantia, Id_Ciudad, Id_Estado) VALUES (:Nombre, :Cuantia, :Id_Ciudad, 3)");

            $this->db->bind(':Nombre',trim($datos['nombreCentro']));
            $this->db->bind(':Cuantia',trim($datos['cuantia']));
            $this->db->bind(':Id_Ciudad', trim($datos['selectNombre']));

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        
        }


        public function add_ciudad($datos){
            $this->db->query("INSERT INTO CIUDAD (Nombre_Ciudad, Distancia) VALUES (:Nombre_Ciudad, :Distancia)");

            $this->db->bind(':Nombre_Ciudad',trim($datos['Nombre_Ciudad']));
            $this->db->bind(':Distancia',trim($datos['Distancia']));

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        
        }


        public function get_ciudades(){
            $this->db->query("SELECT Id_Ciudad as Id, Nombre_Ciudad as Nombre FROM CIUDAD");

            return $this->db->registros();
            
        }


        public function getVisualizarCentro($Id_Centro){
            $this->db->query("SELECT * FROM CENTRO cen, CIUDAD ciu WHERE ciu.Id_Ciudad=cen.Id_Ciudad AND Id_Centro=:Id_Centro");

            $this->db->bind(':Id_Centro', $Id_Centro);

            return $this->db->registro();

        }

        public function editCentro($datos, $Id_Centro){

            $this->db->query("UPDATE CIUDAD SET Nombre_Ciudad=:Nombre_Ciudad, Distancia=:Distancia WHERE Id_Ciudad=:Id_Ciudad");

            $this->db->bind(':Nombre_Ciudad', $datos['Ciudad']);
            $this->db->bind(':Distancia', $datos['Distancia']);
            $this->db->bind(':Id_Ciudad', $datos['Id_Ciudad']);

            $this->db->execute();

            $this->db->query("UPDATE CENTRO SET Nombre=:Nombre, Cuantia=:Cuantia WHERE Id_Centro=:Id_Centro");

            $this->db->bind(':Nombre', $datos['Nombre']);
            $this->db->bind(':Cuantia', $datos['Cuantia']);
            $this->db->bind(':Id_Centro', $Id_Centro);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

    }

?>