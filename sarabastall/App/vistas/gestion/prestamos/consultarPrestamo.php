<?php require_once RUTA_APP.'/vistas/inc/header.php'?>

</head>
<body>
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php RUTA_URL?>/trabajador/menu">Menu</a></li>
        <li class="breadcrumb-item active" aria-current="page">Ver Préstamos</li>
      </ol>
    </nav>
    
    <h1>Préstamos</h1>

    <div class="container">
      <div class="col-3">
        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
          <input type="search" class="form-control form-control-dark" id="buscador" name="buscador" placeholder="Buscador" aria-label="Search" onkeyup="buscar()">
        </form>
        
        <select name="Tipo">
          <option id="pendiente" value="Pendiente" onclick="filtrarTipoPendiente()">Pendiente</option>
          <option id="finalizado" value="Finalizado" onclick="filtrarTipoFinalizado()">Finalizado</option>
        </select>
      </div>
      
      <br>
      
      <table class="table table-striped table-hover">
        <thead class="thead-azul">
          <tr>
            <th scope="col">Nº Préstamo</th>
            <th scope="col">Tipo</th>
            <th scope="col">Nombre Persona</th>
            <th scope="col">Fecha</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Estado</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody id="tbody">
          <?php foreach ($datos["prestamos"] as $prestamo): ?>
            <tr>
              <th scope="row"><?php echo $prestamo ->Id_Prestamo?></th>
              <td><?php echo $prestamo ->NombreTipo?></td>
              <td><?php echo $prestamo ->NombrePers?></td>
              <td><?php echo $prestamo ->Fecha_Inicio?></td>
              <td><?php echo $prestamo ->Importe?></td>
              <td>
                <?php if($prestamo->Id_Estado == 1): ?>
                  <strong class="text-success"><?php echo $prestamo ->NombreEst
                ?>
                <?php elseif($prestamo->Id_Estado == 2): ?>
                  <strong class="text-danger"><?php echo $prestamo ->NombreEst?>
                <?php endif ?>
              </td>
              <td>
                <!--Aqui van 2 botones-->
                <a href="#">
                  <button type="button" class="w-80 btn btn-warning btn-lg">
                    <i class="bi bi-search"></i>
                  </button>
                <a>

                <a href="#">
                  <button type="button" class="w-80 btn btn-warning btn-lg">
                    <i class="bi bi-cash-coin"></i>
                  </button>
                <a>  
              </td>
            </tr>
          <?php endforeach?>
        </tbody>
      </table>
</div>
    
<?php require_once RUTA_APP.'/vistas/inc/footer.php'?>