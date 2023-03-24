<?php 
    function conexion(){
        /* ==================================== */
        //AQUI SE DEBEN ESCRIBIR LOS PARAMETROS DE LA BASE DE DATOS
            $id = "localhost"; //192.168.4.231
            $dbName = "midgard";
            $usuario = "root"; //midgard
            $clave = "Salamence!3"; //midgard
        /* ==================================== */ 
        
        try{
            //HACER LA CONEXIÓN
            $cadenaConexion ="mysql:host=".$id.";dbname=".$dbName;
            $conexion = new PDO($cadenaConexion, $usuario, $clave);

            //HABILITAR ERRORES DE LA BASE DE DATOS (ASI MUESTRA ERRORES DE MYSQL)
            $conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //RETORNAR EL OBJETO CREADO
            return $conexion;

        }catch(Exception $e){
            echo "ERROR AL CONECTAR A LA BASE DE DATOS <br>".$e."<br><br>";
            return null;
        }
    }




        //HACEMOS LA CONSULTA EN LA BASE DE DATOS UTILIZANDO LA VARIABLE ENVIADA EN JAVASCRIPT
        $con = conexion();
        $consulta="SELECT * FROM PUBLICACION";
        $stm = $con->query($consulta);
        $resultado = $stm->fetch();
         
        //ALMACENAMOS EN UN ARRAY ASOCIATIVO EL RESULTADO DE LA CONSULTA
        $cont=0;
        while ($resultado){
             $datos[$cont] = [
                 'id_publicacion' => $resultado['id_publicacion'], 
                 'fechaCreacion' => $resultado['fechaCreacion'], 
                 'titulo' => $resultado['titulo'], 
                 'fechaInicio' => $resultado['fechaInicio'], 
                 'fechaFin' => $resultado['fechaFin'], 
                 'mensaje' => $resultado['mensaje'], 
                 'imagen' => $resultado['imagen'], 
                 'fechaAprobacion' => $resultado['fechaAprobacion'], 
                 'escritor' => $resultado['escritor'], 
                 'aprobador' => $resultado['aprobador'], 
                 'id' => $resultado['id']
             ];
             $cont++;
             $resultado = $stm->fetch();
            }
        //var_dump($datos);
        
        $r = array_search((int)$id, array_column($datos,'id_publicacion'),true);
        var_dump($r);

        if($r>-1){
            echo "Bien";
        }else{
            echo "mal";
        }
