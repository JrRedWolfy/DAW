<?php require_once RUTA_APP.'/vistas/inc/header.php'?>


<div class="container">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo RUTA_URL ?>/admin/index">Menu</a></li>
      <li class="breadcrumb-item"><a href="<?php echo RUTA_URL ?>/admin/gestionar_centros">Gestion Centros</a></li>
      <li class="breadcrumb-item active" aria-current="page">Ver Centro</li>
    </ol>
  </nav>

        
    <div class="col-12">
        <h1>Centro : <?php echo $datos["centro"]->Nombre ?> </h1>
    </div>
    
    <br>

      <div class="row">
        <div class="col-md-12">
          <div class="card">
              <div class="card-body">
                <!-- Formulario rellenado con la informacion del centro para modificar cualquier dato -->
                <form method="post" class="mb-5">
                  <div class="row">

                  <input hidden name="Id_Ciudad" type="text" value="<?php echo $datos["centro"]->Id_Ciudad?>">
                    <div class="mb-3 col-6">
                      <label for="Nombre" class="form-label">Nombre</label>
                      <input type="text" class="form-control" id="Nombre" name="Nombre" value="<?php echo $datos["centro"]->Nombre?>">
                    </div>

                    <div class="mb-3 col-6">
                      <label for="Cuantia" class="form-label">Cuantia</label>
                      <input type="text" class="form-control" id="Cuantia" name="Cuantia" value="<?php echo $datos["centro"]->Cuantia?>">
                    </div>

                    <div class="mb-3 col-6">
                      <label for="Ciudad" class="form-label">Ciudad</label>
                      <input type="text" class="form-control" id="Ciudad" name="Ciudad" value="<?php echo $datos["centro"]->Nombre_Ciudad?>">
                    </div>

                    <div class="mb-3 col-6">
                      <label for="Distancia" class="form-label">Distancia</label>
                      <input type="text" class="form-control" id="Distancia" name="Distancia" value="<?php echo $datos["centro"]->Distancia?>">
                    </div>  

                    <div class="col-8">
                      <button type="submit" class="w-100 btn btn-success btn-lg">Modificar</button>
                    </div>

                    <div class="col-4">
                      <a class="w-100 btn btn-danger btn-lg" href="<?php echo RUTA_URL?>/admin/gestionar_centros">Atras</a>
                    </div>

                  </div>
                </form>
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