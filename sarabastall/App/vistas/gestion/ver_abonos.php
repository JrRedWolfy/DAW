<?php require_once RUTA_APP.'/vistas/inc/header.php'?>


<div class="container">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo RUTA_URL ?>/<?php echo $this->datos['controlador']?>">Menu</a></li>
      <?php if (!tienePrivilegios($this->datos["usuarioSesion"]->Id_Rol, [2])):?>
      <li class="breadcrumb-item"><a href="<?php echo RUTA_URL ?>/<?php echo $this->datos['controlador']?>/gestionar_prestamos">Gestion Prestamos</a></li>
      <?php else: ?>
        <li class="breadcrumb-item"><a href="<?php echo RUTA_URL ?>/<?php echo $this->datos['controlador']?>/gestionar_prestamos">Mis Prestamos</a></li>
      <?php endif ?>
      <li class="breadcrumb-item active" aria-current="page">Abonos</li>
    </ol>
  </nav>

  <?php 
    $total = $datos["prestamo"]->Importe;
    foreach($datos["abonos"] as $abono){
      $total = $total - $abono->Cantidad;
    }
  ?>

  <!-- Modal Abonar -->
    <div class="modal fade" id="modalAbonar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Abonos</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <!-- Añadir Formulario y funcion de crear Abono, y Movimiento -->
            <form method="post" id="formAbonar" action="<?php echo RUTA_URL ?>/admin/add_abono/<?php echo $datos['prestamo']->Id ?>/<?php echo $total ?>">
  
              <div class="mb-3">
                  <label for="Importe" class="form-label">Abonar:</label>
                  <input id="importeMax" name="importe" type="number" step=".01" min="0" max="<?php echo $total ?>" class="form-control" id="Importe" aria-describedby="text" required>
              </div>
    
              <input type="hidden" id="Id_Prestamo" value="<?php echo $datos['prestamo']->Id ?>" name="id_prestamo">
    
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Abonar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
            
    <div class="col-12">
      <h1>[<?php echo $datos["prestamo"]->NombreEst ?>] Prestamo: #<?php echo $datos["prestamo"]->Id ?> </h1>
    </div>
    
    <br>

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <!-- Formulario rellenado con la informacion del centro para modificar cualquier dato -->
            <?php
              echo "<h2>Total a Pagar: <span class='rojo'>".$total."</span></h2>";
              echo "<hr>";
            ?>
            <?php if(count($datos["abonos"]) == 0):?>
              <h3> No se han realizado abonos todavia </h3>
            <?php endif ?>
            
            <?php $n = 1;?>

            <?php foreach($datos["abonos"] as $abono):?>
              <?php echo $n."º-     Se han abonado <span class='verde'>".$abono->Cantidad." €</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp Fecha del Abono: ".$abono->Fecha; ?>
              <?php $n = $n+1;?>
              <hr>
            <?php endforeach?>

            <div class="card-footer">
              <?php if($total != 0):?>
              <?php if (tienePrivilegios($this->datos["usuarioSesion"]->Id_Rol, [1])):?>
              <button class="btn-lg w-80" data-bs-toggle="modal" data-bs-target="#modalAbonar"><i class="fa fa-plus"></i> Añadir Abono</button>
              <?php else: ?>
                <h3>Tienes hasta el dia <span class="rojo"><?php echo $datos["prestamo"]->Fecha_Fin?></span> para devolver el prestamo.</h3>
              <?php endif ?>
              <?php else:?>
              <h3 class="verde">El Prestamo ya se ha devuelto</h3>
              <?php endif?>

            </div>
            </div>
          </div>
        </div>  
        <br>
      </div> 
    </div>
  </div>

<script>
  window.onload=save_config(); // Cargar los datos de Accesibilidad
</script>


<?php require_once RUTA_APP.'/vistas/inc/footer.php'?>