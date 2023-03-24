<?php
// CONSULTAS A LA BASE DE DATOS
$data = ["success"=>false];
$_post = json_decode(file_get_contents('php://input'),true);
if(isset($_post['texto'])):
    // array de ciudades
    $ciudades = array(
        array('id'=>1,'nombre'=>'Zaragoza','poblacion'=> 15000000),
        array('id'=>2,'nombre'=>NULL,'poblacion'=> 120000),
        array('id'=>3,'nombre'=>'Barcelona','poblacion'=> 100000)
    );
    $r = array_search($_post['texto'], array_column($ciudades,'nombre'),true);
    if($r>-1)
        $data = ["success"=>true,'ciudad'=>$ciudades[$r],'mensaje'=>"EXISTEN COINCIDENCIAS"];
    else
        $data = ["success"=>false,'mensaje'=>"NO EXISTEN COINCIDENCIAS"];
endif;
die(json_encode($data));