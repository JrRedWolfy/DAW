<?php require_once RUTA_APP.'/vistas/inc/header_no_login.php';?>

<div id="menuFondo">
    <div class="row d-flex justify-content-center">
        <br>
        <br>
        <div id="loginForm" class="col-4">
            <form method="post">
                <div>
                    <label for="floatingInput">Usuario </label>
                    <input type="text" name="usuario" class="form-control" placeholder="" required >
                </div>
                <br>
                <div>
                    <label for="floatingPassword">Contraseña</label>
                    <input type="password" name="pass" class="form-control"  placeholder="" required>
                </div>

                <?php if(isset($datos['error']) && $datos['error'] == "error_1"): ?>
                    <div class="alert alert-danger" role="alert">
                        Usuario o contraseña incorrecto!!
                    </div>
                <?php endif ?>
                <br>
                <input type="submit" class="btn btn-success" value="Login"></input>
            </form>
        </div>
    </div>
</div>

<?php require_once RUTA_APP.'/vistas/inc/footer.php'?>