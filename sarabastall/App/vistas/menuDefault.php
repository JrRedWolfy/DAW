 <?php require_once RUTA_APP.'/vistas/inc/header.php'?>

<div id="menuFondo">

    <div class="row d-flex justify-content-center text-center" >
        <div class="card text-dark bg-light mb-3 col-3" style="max-width: 18rem;">
            <a href="<?php echo RUTA_URL ?>/defecto/solicitar_prestamo">
                <div class="card-header">
                    <i class="fa fa-light fa-handshake fa-8x"></i>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Pedir Préstamo</h5>
                </div>
            </a>
        </div>

        <div class="card text-dark bg-light mb-3 col-3" style="max-width: 18rem;">
            <a href="<?php echo RUTA_URL ?>/defecto/ver_prestamos">
                <div class="card-header">
                    <i class="fa fa-light fa-eye fa-8x"></i>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Consultar Préstamos</h5>
                </div>
            </a>
        </div>
    </div>
</div>

<?php require_once RUTA_APP.'/vistas/inc/footer.php'?>