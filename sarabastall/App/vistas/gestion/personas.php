<?php require_once RUTA_APP.'/vistas/inc/header.php'?>
</head>
<body>
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo RUTA_URL?>/<?php echo $this->datos['controlador']?>">Menu</a></li>
      <?php if (tienePrivilegios($this->datos["usuarioSesion"]->Id_Rol, [1])):?>
        <li class="breadcrumb-item active" aria-current="page">Gestion Personas</li>
      <?php else:?>
        <li class="breadcrumb-item active" aria-current="page">Gestion Alumnos</li>
      <?php endif?>

      </ol>
    </nav>

    <?php if (tienePrivilegios($this->datos["usuarioSesion"]->Id_Rol, [1])):?>
      <h1>Personas</h1>
    <?php else:?>
      <h1>Alumnos</h1>
    <?php endif?>
    <!-- Modal -->
    <?php if (tienePrivilegios($this->datos["usuarioSesion"]->Id_Rol, [1])):?>
    <button id="abrirModal">+</button>
    <?php else:?>
    <button id="AddAlumno">+</button>
    <?php endif?>


    <!-- Ventana modal AÑADIR ALUMNO EN MASTER -->
    <div id="ModalAlumno" class="modalJS">
      <div class="contenido-modal">
        <span class="cerrarAlu">&times;</span>
        <h6 class="tituloModal">Añadir Alumno</h6>
        <br>
        <hr>
        <form method="post" id="insert_form" onsubmit="return Validar(this, 'nombrePersona', 'apellidosPersona', 'direccionPersona', 'fechaNacimientoPersona')" action="<?php echo RUTA_URL ?>/master/add_alumno">
            <label>Nombre:</label>
            <input type="text" id="nombrePersona" name="nombrePersona">
            <p id="ErrorNombre"></p>
            <label>Apellidos:</label>
            <input type="text" id="apellidosPersona" name="apellidosPersona">
            <p id="ErrorProfesor"></p>

            <label>Genero:</label>
            <select name="genero" id="">
              <option value="Masculino">Masculino</option>
              <option value="Femenino">Femenino</option>
            </select>

            <label>Direccion:</label>
            <input type="text" id="direccionPersona" name="direccionPersona">
            <p id="ErrorProfesor"></p>

            <label>Fecha Nacimiento:</label>
            <input type="date" id="fechaNacimientoPersona" name="fechaNacimientoPersona">
            <p id="ErrorFecha"></p>

            <label>Curso Actual:</label>
            <input type="text" id="cursoActual" name="cursoActual">
            <p id="ErrorImporte"></p>

            <label>Tutor Legal:</label>
            <input type="text" id="tutorLegal" name="tutorLegal">
            <p id="ErrorFecha"></p>
            <br>
            <hr>
            <!--<input class="boton" value="Guardar Cambios" type="button" onclick="importeNoNegativo()">-->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" onclick="validarFormulario()">Añadir Persona</button>
              </div>
            <!-- <div class="">
                <button type="submit" value="Entrar" class="w-100 btn btn-success btn-lg" onclick="validarFormulario()">
                  Añadir
                </button>
            </div> -->
        </form>
    </div>
  </div>


    
    <!-- Ventana modal AÑADIR PERSONA EN ADMIN -->
    <div id="ventanaModal" class="modalJS">
      <div class="contenido-modal">
        <span class="cerrar">&times;</span>
        <h6 class="tituloModal">Añadir Persona</h6>
        <br>
        <hr>
        <form method="post" id="insert_form" onsubmit="return Validar(this, 'nombrePersona', 'apellidosPersona', 'direccionPersona', 'fechaNacimientoPersona', 'emailPersona')" action="<?php echo RUTA_URL ?>/admin/add_persona">
            <label>Nombre:</label>
            <input type="text" id="nombrePersona" name="nombrePersona">
            <p id="ErrorNombre"></p>
            <label>Apellidos:</label>
            <input type="text" id="apellidosPersona" name="apellidosPersona">
            <p id="ErrorProfesor"></p>

            <label>Genero:</label>
            <select name="genero" id="">
              <option value="Masculino">Masculino</option>
              <option value="Femenino">Femenino</option>
            </select>

            <label>Direccion:</label>
            <input type="text" id="direccionPersona" name="direccionPersona">
            <p id="ErrorProfesor"></p>

            <label>Fecha Nacimiento:</label>
            <input type="date" id="fechaNacimientoPersona" name="fechaNacimientoPersona">
            <p id="ErrorFecha"></p>

            <label>Telefono:</label>
            <input type="text" id="telefonoPersona" name="telefonoPersona">
            <p id="ErrorImporte"></p>

            <label>Email:</label>
            <input type="text" id="emailPersona" name="emailPersona">
            <p id="ErrorFecha"></p>
            <br>
            <hr>
            <!--<input class="boton" value="Guardar Cambios" type="button" onclick="importeNoNegativo()">-->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" onclick="validarFormulario()">Añadir Persona</button>
              </div>
            <!-- <div class="">
                <button type="submit" value="Entrar" class="w-100 btn btn-success btn-lg" onclick="validarFormulario()">
                  Añadir
                </button>
            </div> -->
        </form>
    </div>
  </div>

<!-- Modal Seguro desea Eliminar -->
<div class="modal fade" id="modalEliminarpersona" tabindex="-1">
  <div class="modal-dialog modal-dialog-center"> 
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="modalCerrarAccionLabel">
                        ¿Estas seguro que quieres eliminar la persona?
              </h5>
          </div>

          <div  class="modal-footer"> 
              <form method="post" id="formCerrarAccion" action="<?php echo RUTA_URL ?>/admin/del_persona">
              <input type="hidden" id="Id_Eliminar" name="id_persona">
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

<!-- Modal Crear Usuario-->
<div class="modal fade" id="modalNewUser" tabindex="-1">
  <div class="modal-dialog modal-dialog-center"> 
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="modalCerrarNewUserLabel">
                Añadir Usuario
              </h5>
          </div>

          <div class="modal-footer"> 
            <form method="post" id="formCerrarAccion" action="<?php echo RUTA_URL ?>/admin/new_usuario">
              
              <label for="Importe" class="form-label">Usuario</label>
              <input type="text" class="form-control" name="usuario" aria-describedby="text" required>
              
              
              <label for="exampleFormControlInput1" class="form-label">Contraseña</label>
              <input type="taxt" class="form-control" name="clave" required>
              
              <label for="exampleFormControlInput1" class="form-label">Rol</label>
              <select name="rol" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                <?php foreach($datos["roles"] as $rol): ?>
                  <?php if ($rol->Id != 6): ?>
                    <option value="<?php echo $rol->Id ?>"><?php echo $rol->Nombre ?></option>
                  <?php endif ?>
                <?php endforeach ?>
              </select>

              <input type="hidden" id="Id_User" name="id_user">
              <br>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                Cancelar
              </button>
              <button type="submit" class="btn btn-success">
                Crear
              </button>
            </form>
          </div>
      </div>
  </div> 
</div>

<input disabled id="page_controller" name="persona" value="0" hidden>

<div class="container">
    <div class="col-2">
      <input type="search" class="color_input" id="buscador" name="buscador" placeholder="Buscador" aria-label="Search" onkeyup="mod_show()">
    </div>


<?php if (tienePrivilegios($this->datos["usuarioSesion"]->Id_Rol, [1])):?>
  <div class="col-3">
    <select id="panel_filtro" name="Tipo" onchange="mod_show()" class="form-select color_input form-select-lg mb-3" aria-label=".form-select-lg example">
      <option id="refresh" value="0" selected></option>
        <?php foreach($datos["roles"] as $rol): ?>
          <option value="<?php echo $rol->Id ?>"><?php echo $rol->Nombre ?></option>
        <?php endforeach ?>
    </select>
    <br>
  </div>
  <?php endif?>

  <input disabled id="page_controller" name="persona" value="0" hidden>

  <table id="tabla_gestion" class="table color_sheet table_sheet table-hover">
    <thead class="thead-azul">
      <tr>
        <th scope="col">Nº</th>
      <?php if (tienePrivilegios($this->datos["usuarioSesion"]->Id_Rol, [1])):?>
        <th scope="col">Tipo Rol</th>
        <?php endif?>

        <th scope="col">Nombre </th>
        <th scope="col">Apellidos</th>
        <th scope="col">Direccion</th>
        <th scope="col">Fecha Nacimiento <button type="button" name="2" value="1" onclick="mod_show(this)"><i class="fa fa-sort"></i></button></th>

      <?php if (tienePrivilegios($this->datos["usuarioSesion"]->Id_Rol, [1])):?>
        <th scope="col">Telefono</th>
        <th scope="col">Email</th>
        <th scope="col">Usuario</th>
        <th scope="col">Detalle</th>
      <?php else:?>
        <th scope="col">Curso</th>
        <th scope="col">Tutor</th>
      <?php endif?>


      </tr>
    </thead>

    <tbody id="contenido_tabla"></tbody>
  </table>

  <div class="Cursos">
    <nav aria-label="Page navigation example">
      <ul id="page_panel" class="pagination justify-content-center"></ul>
    </nav>
  </div>

  <h2 id="nomaches"></h2>

  <script>
    window.onload=caja_fuerte(<?php echo json_encode($datos["PersonasTotales"])?>, <?php echo json_encode($datos["usuarioSesion"]->Nombre)?>, <?php echo $datos["usuarioSesion"]->Id_Rol?>);
    window.onload=listar_elementos(true);
    window.onload=save_config(); // Cargar los datos de Accesibilidad
  </script>

</div>

<br>
<br>
<br>

<?php require_once RUTA_APP.'/vistas/inc/footer.php'?>