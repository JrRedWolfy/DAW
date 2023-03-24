<?php require_once RUTA_APP.'/vistas/inc/header.php'?>

<!-- Si no es el profesor que lleva el curso, no puede editarlo -->
<?php 
  $estadoFormulario ="";
  if($datos['curso']->Profesor != $datos['usuarioSesion']->Nombre){
    $estadoFormulario = "disabled";
  } 
?>



<div class="container">
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
    <?php if (tienePrivilegios($this->datos["usuarioSesion"]->Id_Rol, [1])):?>
          <li class="breadcrumb-item"><a href="<?php echo RUTA_URL?>/<?php echo $this->datos['controlador']?>">Menu</a></li>
    <?php endif?>
          <li class="breadcrumb-item"><a href="<?php echo RUTA_URL ?>/<?php echo $this->datos['controlador']?>/gestionar_cursos">Gestion Cursos</a></li>
          <li class="breadcrumb-item active" aria-current="page">Ver Curso</li>
        </ol>
    </nav>
    
    <div class="col-12">
      <h1>Curso : <?php echo $datos["curso"]->Curso ?></h1>
    </div>
    <br>


    <div class="row">
        <div class="col-md-7">
        

        <!-- Añadir textarea y boton para añadir nuevos materiales -->
        <div class="card">
          
          <form method="post" action="<?php echo RUTA_URL?>/<?php echo $this->datos['controlador']?>/add_material/<?php echo $this->datos['curso']->Id?>">
            <br>
            <input type="hidden" name="id_curso" value="<?php echo $datos['curso']->Id ?>">

            <div class="row">
              <div class="col-mb-3 col-10">

                  <textarea class="form-control form-control-sm" id="accion" name="nombre" placeholder="Agregar Material"></textarea>
              </div>
              <div class="col-mb-3 col-2">
                  <button type="submit" class="w-100 btn btn-success btn-lg">Añadir</button>
              </div>
            </div>
            <br>
          </form>
          
        </div>
         
        

        <div class="card">
            <div class="card-body">
            <!-- Formulario rellenado con la informacion de la asesoria para modificar cualquier dato -->
            <form method="post" class="mb-5">
              <div class="row">
                <div class="mb-6 col-6">
                  <label for="nombre" class="form-label">Nombre</label>
                  <input <?php echo $estadoFormulario ?> type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $datos["curso"]->Curso?>">
                </div>
                <div class="mb-3 col-6">
                  <label for="especialidad" class="form-label">Especialidad</label>
                  <select <?php echo $estadoFormulario ?> name="tipo">
                    <?php foreach($datos["especialidades"] as $especialidad): ?>
                      <?php if($datos["curso"]->Especialidad != $especialidad->Nombre): ?>
                        <option value="<?php echo $especialidad->Id ?>"><?php echo $especialidad->Nombre ?></option>
                      <?php else: ?>
                        <option selected value="<?php echo $especialidad->Id ?>"><?php echo $especialidad->Nombre ?></option>
                      <?php endif ?>

                    <?php endforeach ?>
                  </select>
                </div>

                <div class="mb-3 col-6">
                  <label for="profesor" class="form-label">Profesor</label>
                  <select <?php echo $estadoFormulario ?> name="profesor">
                    <?php foreach($datos["profesores"] as $profesor): ?>
                        <?php if($datos["curso"]->Profesor != $profesor->Nombre): ?>
                          <option value="<?php echo $profesor->Id ?>"><?php echo $profesor->Nombre ?></option>
                        <?php else: ?>
                          <option selected value="<?php echo $profesor->Id ?>"><?php echo $profesor->Nombre ?></option>
                        <?php endif ?>
                    <?php endforeach ?>
                  </select>
                </div>

                <!-- <div class="mb-3 col-6">
                  <label for="importe" class="form-label">Importe</label>
                  <input <?php echo $estadoFormulario ?> type="text" class="form-control" id="importe" name="importe" value="<?php echo $datos["curso"]->Importe?>">
                </div> -->
                <div class="mb-3 col-6">
                  <label for="importe" class="form-label">Fecha de Finalizacion</label>
                  <input <?php echo $estadoFormulario ?> type="date" class="form-control" id="fecha" name="fecha" value="<?php echo $datos["curso"]->Fecha?>">
                </div> 

                <!-- <div class="card-footer d-flex justify-content-end">
                    <span class="card-text">#<?php echo $datos["curso"]->Id?></span>
                </div> -->

                <div class="col-8">
                  <button type="submit" class="w-100 btn btn-success btn-lg" <?php echo $estadoFormulario ?>>Modificar</button>
                </div>
                <div class="col-4">
                  <a class="w-100 btn btn-danger btn-lg" href="<?php echo RUTA_URL?>/<?php echo $this->datos['controlador']?>/gestionar_cursos">Atras</a>
                </div>
              </div>
            </form>
          </div>
        </div>  

        <div class="card">
          
        <?php foreach($datos["curso"]->participante as $participante): ?>
          <div class="card">
            <div class="card-body">
              <h5 class="card-subtitle"> <?php echo $participante->Nombre ?></h5>
              <p class="card-text ps-2"> <?php echo $participante->Apellidos ?></p>
              <a class="btn btn-danger btn-lg ml-auto" style="float:right" href="<?php echo RUTA_URL?>/admin/del_join/<?php echo $datos['curso']->Id?>/<?php echo $participante->Id?>"><i class="bi bi-trash"></i></a>
              <div class="card-footer d-flex justify-content-end">
                <span class="card-text">Se apunto el dia: <?php echo $participante->Fecha?></span>
              </div>
            </div>
          </div>
          <?php endforeach?>
          
        </div>


        </div>

        <!-- Material que tiene dicho Curso-->
        <div class="col-md-3">
          <?php foreach($datos["curso"]->material as $material): ?>
          <div class="card">
            <div class="card-body">
              <h5 class="card-subtitle"> <?php echo $material->Nombre ?>:</h5>
              <p class="card-text ps-2"> <?php echo $material->Archivo ?></p>
              <a class="btn btn-danger btn-lg ml-auto" style="float:right" href="<?php echo RUTA_URL?>/<?php echo $this->datos['controlador']?>/del_material/<?php echo $datos['curso']->Id?>/<?php echo $material->Id?>"><i class="bi bi-trash"></i></a>
              <div class="card-footer d-flex justify-content-end">
                <span class="card-text">#<?php echo $material->Id?></span>
              </div>
            </div>
          </div>
          <?php endforeach?>
        </div>  
    </div>
</div>

<div class="modal fade" id="modalCerrarAccion" tabindex="-1">
  <div class="modal-dialog modal-dialog-center"> 
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="modalCerrarAccionLabel">
                        ¿Estas seguro que quieres cerrar la Asesoria?
              </h5>
          </div>

          <div  class="modal-footer"> 
              <form method="post" id="formCerrarAccion" action="<?php echo RUTA_URL ?>/asesorias/cerrar_accion">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                          Cancelar
                    </button>
                      
                    <button type="submit" class="btn btn-warning">
                          Cerrar Asesoria
                    </button>
                      
                    <input type="hidden" id="id_asesoria" name="id_asesoria">
              </form>
          </div>
      </div>
  </div> 
</div>

  <script>
      function valida_cerrar(id_asesoria){
        document.getElementById("id_asesoria").value = id_asesoria
      }
      window.onload=save_config(); // Cargar los datos de Accesibilidad
  </script>

<?php require_once RUTA_APP.'/vistas/inc/footer.php'?>