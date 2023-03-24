<?php require_once RUTA_APP.'/vistas/inc/header.php'?>

</head>
<body>
<div class="container">
  <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
  <?php if (tienePrivilegios($this->datos["usuarioSesion"]->Id_Rol, [1])):?>
        <li class="breadcrumb-item"><a href="<?php echo RUTA_URL?>/<?php echo $this->datos['controlador']?>">Menu</a></li>
  <?php endif?>
        <li class="breadcrumb-item active" aria-current="page">Gestion Cursos</li>
    </ol>
  </nav>
    
  <h1>Cursos</h1>

    <!-- FILTROS -->

    <!--Funcion array y pagina que devuelva el nuevo array-->
    
<!-- Button trigger modal -->
<!-- <button type="button" id="anadir" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
+
</button> -->


<!-- Modal -->

  <?php if (tienePrivilegios($this->datos["usuarioSesion"]->Id_Rol, [5, 1])):?>

    <button id="abrirModal">+</button>

    <!-- Ventana modal JS -->
    <div id="ventanaModal" class="modalJS">
      <div class="contenido-modal">
          <span class="cerrar">&times;</span>
          <h6 class="tituloModal">Nuevo Curso</h6>
          <br>
          <hr>
          <form method="post" id="insert_form" onsubmit="return Validar(this, 'nombreCurso', 'profesor', 'fechaCurso')" action="<?php echo RUTA_URL ?>/<?php echo $this->datos['controlador']?>/add_curso">
              <label>Nombre:</label>
              <input type="text" id="nombreCurso" name="nombre" class="color_input">
              <p id="ErrorNombre"></p>

              <?php if (!tienePrivilegios($this->datos["usuarioSesion"]->Id_Rol, [5])):?>

              <label>Profesor:</label>
              <select name="profesor" class="color_input" class="color_input">
                <?php foreach($datos["profesores"] as $profesor): ?>
                    <option value="<?php echo $profesor->Id ?>"><?php echo $profesor->Nombre ?></option>
                <?php endforeach ?>
              </select> <!--Problemas(FIXED), El Admin debe seleccionar un profesor de la bbdd e dejarlo indicado(de alguna frma, manteniendo el id del profe)-->

              <?php endif?>

              <label>Tipo de curso:</label>
              <select name="tipo">
                <?php foreach($datos["especialidades"] as $especialidad): ?>
                  <option value="<?php echo $especialidad->Id ?>"><?php echo $especialidad->Nombre ?></option>
                <?php endforeach ?>
              </select>
              <br>
              <label>Fecha:</label>
              <input type="date" id="fechaCurso" name="fecha" class="color_input">
              <p id="ErrorFecha"></p>
              <br>
              <hr>
              <!-- <input class="boton" value="Guardar Cambios" type="button" onclick="importeNoNegativo()"> -->
              <!-- <input type="submit" value="Entrar" onclick="todos()" class="color_input"> -->
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary" onclick="validarFormulario()">Añadir Curso</button>
              </div>
          </form>
      </div>
    </div>
  <?php endif ?>

  <!-- Modal Seguro desea Eliminar -->
    <div class="modal fade" id="modalEliminarcurso" tabindex="-1">
      <div class="modal-dialog modal-dialog-center"> 
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalCerrarAccionLabel">
              ¿Estas seguro que quieres eliminar el curso?
            </h5>
          </div>

          <div  class="modal-footer"> 
            <form method="post" id="formCerrarAccion" action="<?php echo RUTA_URL ?>/<?php echo $this->datos['controlador']?>/del_curso">    
              <input type="hidden" id="Id_Eliminar" name="id_curso">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                Cancelar
              </button>
                    
              <button type="submit" class="btn btn-warning">
                Eliminar
              </button>
            </form>
          </div>
        </div>
      </div> 
    </div>

  <!-- BUSCADOR + FILTROS -->
    <div class="container">
      <div class="col-2">
        <input type="search" class="color_input" id="buscador" name="buscador" placeholder="Buscador" aria-label="Search" onkeyup="mod_show()">
      </div>
      
      <div class="col-3">
        <select id="panel_filtro" name="Tipo" onchange="mod_show()" class="color_input">
          <option id="refresh" value="0" selected></option>
          <?php foreach($datos["especialidades"] as $especialidad): ?>
            <option value="<?php echo $especialidad->Id ?>"><?php echo $especialidad->Nombre ?></option>
          <?php endforeach ?>
        </select>
        <br>
      </div>

      <?php if (tienePrivilegios($this->datos["usuarioSesion"]->Id_Rol, [8])):?>
        <div class="col-4">
          <select id="panel_filtro" name="Tipo" onchange="fetch_cursos(this)" class="color_input">
            <option id="refresh" value="0" selected>Todos</option>
            <option value="aviable">Disponibles</option>
            <option value="apuntado">Mis Cursos</option>
            <option value="completo">Realizados</option>  
          </select>
        </div>
      <?php endif ?>
    </div>

  <input disabled id="page_controller" name="curso" value="0" hidden>

  <table id="tabla_gestion" class="table color_sheet table_sheet table-hover">
    <thead class="thead-azul">
      <tr>
        <th scope="col">Nº Curso</th>
        <th scope="col">Especialidad</th>
        <th scope="col">Nombre</th>
        <th scope="col">Profesor</th>
        <th scope="col">Fecha <button type="button" name="4" value="1" onclick="mod_show(this)"><i class="fa fa-sort"></i></button></th>
        <?php if (tienePrivilegios($this->datos["usuarioSesion"]->Id_Rol, [2])): ?>
        <th scope="col">Apuntado</th>
        <?php endif ?>
        <th scope="col">Detalle</th>
      </tr>
    </thead> 
    <tbody id ="contenido_tabla"></tbody>
  </table>

  <div class="Cursos">
    <nav aria-label="Page navigation example">
      <ul id="page_panel" class="pagination justify-content-center"></ul>
    </nav>
  </div>

  <h2 id="nomaches"></h2>

</div>



<br>
<br>
<br>

<script>
  window.onload=caja_fuerte(<?php echo json_encode($datos["CursosTotales"])?>, <?php echo json_encode($datos["usuarioSesion"]->Nombre)?>, <?php echo $datos["usuarioSesion"]->Id_Rol?>); // Aqui pasamos el array en cuestion recibido por PHP

  window.onload=listar_elementos(true); // Se le pasa true indicando que es la primera vez que se ejecuta la funcion

  window.onload=save_config(); // Cargar los datos de Accesibilidad

  // Este es un Fetch para reasignar el array de cursos segun la seleccion especificada por el trabajador
  async function fetch_cursos(flag){
  
    funcion = flag.options[flag.selectedIndex].value;
    controlador = "";

    switch(rol){
      case 5:
        controlador = "profesor";
        break;
      case 2:
        controlador = "trabajador";
        break;
    }

    await fetch(`<?php echo RUTA_URL?>/`+controlador+`/agrupar_cursos/`+funcion+`/<?php echo $datos["usuarioSesion"]->Id_Persona?>`, {
        method: "GET",
    })
        .then((resp) => resp.json())
        .then(function(data) {
          console.log(data);
            if(data){
              caja_fuerte(data);
              mod_show();  
            } else {
              alert("Ha surgido un error inesperado, posiblemente por tu culpa, desgraciado: Deja de intentar hackearnos");
            }
            
        })
    }
</script>
    
    
<?php require_once RUTA_APP.'/vistas/inc/footer.php'?>