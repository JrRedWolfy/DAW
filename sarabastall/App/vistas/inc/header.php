<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo NOMBRE_SITIO?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com/%22%3E">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@100;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com/%22%3E">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@100;400&family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
    
    <link rel="icon" type="image/png" href="<?php echo RUTA_URL_STATIC?>/img/favicon.png"/>
    <link rel="stylesheet" href="<?php echo RUTA_URL_STATIC?>/css/estilos.css">
    <script src="<?php echo RUTA_URL_STATIC?>/js/paginacion.js"></script>
    <script src="<?php echo RUTA_URL_STATIC?>/js/accesibilidad.js"></script>
</head>

<body id="fondo_color" class="color_fondo">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="<?php echo RUTA_URL_STATIC?>/img/logo-fundacion-sarabastal.png" width="290" height="58" class="d-inline-block align-text-top">
      </a>
    </div>

    <ul class="navbar-nav ms-auto mb-2 md-8">
      <li class="navbar-text">
        <?php echo $datos['usuarioSesion']->Nombre ?>
      </li>
      <li class="nav-item">
        <a class="btn btn-outline-danger btn-lg" href="<?php echo RUTA_URL ?>/login/logout">
          <i class="bi bi-box-arrow-left"></i>
        </a>
      </li>
    </ul>
  </nav>