<?php
    class LoginModelo{
        private $db;

        public function __construct(){
            $this->db = new Base;
        }

        public function loginUsuario($datos){
            $this->db->query("SELECT * FROM PERSONA WHERE Login = :Login AND Password = sha2(:pass,256)");
        
            $this->db->bind(':Login', $datos['usuario']);
            $this->db->bind(':pass', $datos['password']);

    
            return $this->db->registro();

        }
    }
?>