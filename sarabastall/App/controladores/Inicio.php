<?php

class Inicio extends Controlador{

    public function __construct(){

        $this->datos["menuActivo"] = "home";

        $this->datos["rolesPermitidos"] = [1, 2, 3, 4, 5];

    }   
    
    public function index(){
        $this->vista("primera",$this->datos);
    }  
}