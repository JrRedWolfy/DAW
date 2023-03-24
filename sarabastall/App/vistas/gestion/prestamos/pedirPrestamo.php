<?php require_once RUTA_APP.'/vistas/inc/header.php'?>

</head>
<body>
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php RUTA_URL?>/<?php echo $this->datos['controlador']?>/menu">Menu</a></li>
        <li class="breadcrumb-item active" aria-current="page">Pedir Préstamo</li>
      </ol>
    </nav>
    
    <h1>Préstamos</h1>
  
    <div class="container">
      <form method="post" action="<?php echo RUTA_URL ?>/<?php echo $this->datos['controlador']?>/pedir_prestamo">
        <div class="row">
          <div class="col-12">
            <div class="mb-3">
              <label for="Concepto" class="form-label">Concepto:</label>
              <input type="text" class="form-control" id="concepto" name="concepto" aria-describedby="text">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-4">
            <label for="NombreText" class="form-label">Tipo de Préstamo:</label>
            <select name="Id_TipoPrestamo">
              <?php foreach($datos["tipoprestamo"] as $tipoPrestamo): ?>
                <option value="<?php echo $tipoPrestamo->Id_TipoPrestamo ?>"><?php echo $tipoPrestamo->Nombre?></option>
              <?php endforeach?>
            </select>
          </div>

          <div class="col-4">
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Fecha Fin:</label>
              <input type="date" class="form-control" id="fecha_fin" name="fecha_fin">
            </div>
          </div>
    
          <div class="col-4">
            <div class="mb-3">
              <label for="Importe" class="form-label">Importe:</label>
              <input type="number" step="1.00" class="form-control" id="importe" name="importe" aria-describedby="text" required>
            </div>
          </div>
        <div>
    
        <br>
        <div class="form-floating">
          <textarea class="form-control" placeholder="Leave a comment here" id="observaciones" name="observaciones"></textarea>
          <label for="floatingTextarea">Observaciones</label>
        </div>
        </div>
        <div class="modal-footer">
          <a href="<?php RUTA_URL?>/trabajador/menu" class="btn btn-secondary" role="button">Cerrar</a>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>
      </form>
    </div>


<?php require_once RUTA_APP.'/vistas/inc/footer.php'?>