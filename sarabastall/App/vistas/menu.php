<?php require_once RUTA_APP.'/vistas/inc/header.php'?>

    <div>
        <div class="row d-flex justify-content-center text-center" >
                <div class="card text-dark bg-light mb-3 col-3" style="max-width: 18rem;">
                  <a href="<?php echo RUTA_URL ?>/admin/gestionar_prestamos">
                    <div class="card-header">
                      <i class="fa fa-dollar-sign fa-8x"></i>
                    </div>
                    <div class="card-body">
                      <h5 class="card-title">Gestión Prestamos</h5>
                    </div>
                  </a>
                </div>

                <div class="card text-dark bg-light mb-3 col-3" style="max-width: 18rem;">
                  <a href="<?php echo RUTA_URL ?>/admin/gestionar_becas">
                    <div class="card-header">
                      <i class="fa fa-graduation-cap fa-8x"></i>
                    </div>
                    <div class="card-body">
                      <h5 class="card-title">Gestión Becas</h5>
                    </div>
                  </a>
                </div>

                <div class="card text-dark bg-light mb-3 col-3" style="max-width: 18rem;">
                  <a href="<?php echo RUTA_URL ?>/admin/gestionar_cursos">
                    <div class="card-header">
                      <i class="fa fa-book fa-8x" aria-hidden="true"></i>
                    </div>
                    <div class="card-body">
                      <h5 class="card-title">Gestión Cursos</h5>
                    </div>
                  </a>
                </div>

                <div class="card text-dark bg-light mb-3 col-3" style="max-width: 18rem;">
                  <a href="<?php echo RUTA_URL ?>/admin/gestionar_economia">
                    <div class="card-header">
                      <i class="fa fa-chart-line fa-8x"></i>
                    </div>
                    <div class="card-body">
                      <h5 class="card-title">Gestión Economia</h5>
                    </div>
                  </a>
                </div>

                <div class="card text-dark bg-light mb-3 col-3" style="max-width: 18rem;">
                  <a href="<?php echo RUTA_URL ?>/admin/gestionar_personas">
                    <div class="card-header">
                      <i class="fa fa-address-book fa-8x"></i>
                    </div>
                    <div class="card-body">
                      <h5 class="card-title">Gestión Personas</h5>
                    </div>
                  </a>
                </div>

                <div class="card text-dark bg-light mb-3 col-3" style="max-width: 18rem;">
                  <a href="<?php echo RUTA_URL ?>/admin/gestionar_centros">
                    <div class="card-header">
                      <i class="fa fa-university fa-8x"></i>
                    </div>
                    <div class="card-body">
                      <h5 class="card-title">Gestión Centros</h5>
                    </div>
                  </a>
                </div>
        </div>
    </div>

<script>
  window.onload=save_config(); // Cargar los datos de Accesibilidad
</script>
   
<?php require_once RUTA_APP.'/vistas/inc/footer.php'?>