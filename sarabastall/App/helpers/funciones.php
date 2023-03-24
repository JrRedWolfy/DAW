<?php

    function redireccionar($pagina){
        header('location: '.RUTA_URL.$pagina);
    }

    function formatFecha($fechaIngles){
        return date("d/m/Y H:i:s", strtotime($fechaIngles));
    }

    function tienePrivilegios($rol, $permitidos){
        if(empty($permitidos) || in_array($rol, $permitidos)){
            return true;
        }
    }
?>