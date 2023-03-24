<?php require_once RUTA_APP.'/vistas/inc/header.php'?>
</head>
<body>

<div class="container">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo RUTA_URL ?>/admin">Menu</a></li>
      <li class="breadcrumb-item"><a href="<?php echo RUTA_URL ?>/admin/gestionar_personas">Gestion Personas</a></li>
      <li class="breadcrumb-item active" aria-current="page">Editar Persona</li>
    </ol>
  </nav>
      
  <div class="card">
    <div class="card-body">
      <form method="post" class="mb-5">
          <div class="row">
          <input type="hidden" name="id_persona" value="<?php echo $datos['persona']->Id_Persona?>">


            <div class="mb-3 col-6">
              <label for="nombre_persona" class="form-label">Nombre</label>
              <input type="text" class="form-control" id="nombre_persona" name="nombre_persona" value="<?php echo $datos["persona"]->Nombre?>">
            </div>

            <div class="mb-3 col-6">
              <label for="apellido_persona" class="form-label">Apellidos</label>
              <input type="text" class="form-control" id="apellido_persona" name="apellido_persona" value="<?php echo $datos["persona"]->Apellidos?>">
            </div>

            <div class="mb-3 col-6">
              <label for="direccion_persona" class="form-label">Direccion</label>
              <input type="text" class="form-control" id="direccion_persona" name="direccion_persona" value="<?php echo $datos["persona"]->Direccion?>">
            </div>

            <div class="mb-3 col-6">
              <label for="fecha_nacimiento_persona" class="form-label">Fecha Nacimiento</label>
              <input type="date" class="form-control" id="fecha_nacimiento_persona" name="fecha_nacimiento_persona" value="<?php echo $datos["persona"]->Fecha_Nacimiento?>">
            </div> 

            <div class="mb-3 col-6">
              <label for="email_persona" class="form-label">Email</label>
              <input type="email" class="form-control" id="email_persona" name="email_persona" value="<?php echo $datos["persona"]->Email?>">
            </div>

            <div class="mb-3 col-6">
              <label for="telefono_persona" class="form-label">Telefono</label>
              <input type="text" class="form-control" id="telefono_persona" name="telefono_persona" value="<?php echo $datos["persona"]->Telefono?>">
            </div> 

            <div class="mb-3">
              <label for="login_persona" class="form-label">Login</label>
              <input type="text" class="form-control" id="login_persona" name="login_persona" value="<?php echo $datos["persona"]->Login?>">

            </div> 

            <div class="col-10">
              <button type="submit" class="w-100 btn btn-success btn-lg">Modificar</button>
            </div>
            <div class="col-2">
              <a class="w-80 btn btn-danger btn-lg" href="<?php echo RUTA_URL?>/admin/gestionar_personas">Atras</a>
            </div>

            </div>
      </form>
    </div>
</div>

<script>
  window.onload=save_config(); // Cargar los datos de Accesibilidad  
</script>

<?php require_once RUTA_APP.'/vistas/inc/footer.php'?>