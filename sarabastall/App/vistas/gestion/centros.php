<?php require_once RUTA_APP.'/vistas/inc/header.php'?>

</head>
<body>
<div class="container">
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php RUTA_URL?>/admin/menu">Menu</a></li>
        <li class="breadcrumb-item active" aria-current="page">Gestion Centros</li>
    </ol>
</nav>
    <h1>CENTROS</h1>

    <button id="botonCiudad">Añadir Nueva Ciudad</button>


<!-- Ventana modal para insertar un nuevo centro -->
<div id="ventanaModal" class="modalJS">
    <div class="contenido-modal">
        <span class="cerrar">&times;</span>
        <h4 class="tituloModal">Crear nuevo centro</h4>
        <br>
        <hr>
        <form method="post" id="insert_form" onsubmit="return Validar(this, 'nombreCentro', 'cuantia')" action="<?php echo RUTA_URL ?>/admin/add_centro">
            <label>Nombre Centro:</label>
            <input type="text" id="nombreCentro" name="nombreCentro" class="color_input">
            <p id="ErrorNombre"></p>

            <label>Ciudad:</label>
            <select name="selectNombre" class="color_input">
              <?php foreach($datos["ciudades"] as $ciudad): ?>
                <option value="<?php echo $ciudad->Id ?>"><?php echo $ciudad->Nombre?></option>
              <?php endforeach ?>
            </select>

            <label>Cuantia:</label>
            <input type="number" step="any" id="cuantia" name="cuantia" class="color_input"> 
            <p id="ErrorCuantia"></p>

            <!-- <input type="submit" value="Insertar" onclick="validarFormulario()" class="color_input"> -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" onclick="validarFormulario()">Añadir Centro</button>
              </div>
        </form>

    </div>
</div>

<!-- Ventana modal para añadir nuevas ciudades -->
<div id="MODAlciudad" class="modalJS">
      <div class="contenidoModal">
          <span class="cerrar">&times;</span>
          <h4 class="titulo">Crear nuevas ciudades</h4>
          <br>
          <br>
          <form method="post" action="<?php echo RUTA_URL ?>/admin/add_ciudad">
              <label>Nombre Ciudad:</label>
              <input type="text" id="Nombre_Ciudad" name="Nombre_Ciudad">

              <label>Distancia:</label>
              <input type="number" step="any" id="Distancia" name="Distancia" class="color_input">

              <!-- <input type="submit" value="Agregar" onclick="todos()" class="color_input"> -->
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary" onclick="validarFormulario()">Añadir Ciudad</button>
              </div>
          </form>
      </div>
  </div>

<!-- Modal Seguro desea Eliminar -->

<div class="modal fade" id="modalEliminarcentro" tabindex="-1">
  <div class="modal-dialog modal-dialog-center"> 
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="modalCerrarAccionLabel">
                        ¿Estas seguro que quieres eliminar el centro?
              </h5>
          </div>

          <div  class="modal-footer"> 
              <form method="post" id="formCerrarAccion" action="<?php echo RUTA_URL ?>/admin/del_centro">
              
                <input type="hidden" id="Id_Eliminar" name="id_centro">
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


<div id="container">

  <div class="col-2">
    <input type="search" class="color_input" id="buscador" name="buscador" placeholder="Buscador" aria-label="Search" onkeyup="mod_show()">
  </div>
  <div class="col-3">
    <select id="panel_filtro" name="Tipo" onchange="mod_show()" class="color_input">
    <option id="refresh" value="0" selected></option>
      <?php foreach($datos["ciudades"] as $ciudad): ?>
        <option value="<?php echo $ciudad->Id ?>"><?php echo $ciudad->Nombre ?></option>
      <?php endforeach ?>
    </select>
    <br>
  </div>



 <button type="button" id="abrirModal" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">+</button> 


  <br>
  <br>
  <br>

  <input disabled id="page_controller" name="centro" value="0" hidden>
  <div class="container">
    <table id="tabla_gestion" class="table color_sheet table_sheet table-hover">
      <thead class="thead-azul">
        <tr>
          <th scope="col">Nº Centro <button type="button" name="0" value="1" onclick="mod_show(this)"><i class="fa fa-sort"></i></button></th>
          <th scope="col">Ciudad <button type="button" name="1" value="1" onclick="mod_show(this)"><i class="fa fa-sort"></i></button></th>
          <th scope="col">Nombre Centro <button type="button" name="2" value="1" onclick="mod_show(this)"><i class="fa fa-sort"></i></button></th>
          <th scope="col">Cuantia <button type="button" name="3" value="1" onclick="mod_show(this)"><i class="fa fa-sort"></i></button></th>
          <th scope="col">Distancia <button type="button" name="4" value="1" onclick="mod_show(this)"><i class="fa fa-sort"></i></button></th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody id="contenido_tabla">
          
      </tbody>
    </table>

    <div class="Centros">
      <nav aria-label="Page navigation example">
        <ul id="page_panel" class="pagination justify-content-center">
          
        </ul>
      </nav>
    </div>

    <h2 id="nomaches"></h2>

  </div>

  <br>
  <br>
  <br>
  

<script>

  window.onload=caja_fuerte(<?php echo json_encode($datos["centros"])?>, <?php echo json_encode($datos["usuarioSesion"]->Nombre)?>, <?php echo $datos["usuarioSesion"]->Id_Rol?>); // Aqui pasamos el array en cuestion recibido por PHP

  window.onload=listar_elementos(true); // Se le pasa true indicando que es la primera vez que se ejecuta la funcion

  window.onload=save_config(); // Cargar los datos de Accesibilidad

</script>
    

    
<?php require_once RUTA_APP.'/vistas/inc/footer.php'?>