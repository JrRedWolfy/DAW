<?php require_once RUTA_APP.'/vistas/inc/header.php'?>

<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php RUTA_URL?>/admin/menu">Menu</a></li>
            <li class="breadcrumb-item active" aria-current="page">Gestion Economia</li>
        </ol>
    </nav>

    <div id="ventanaModal" class="modalJS"> 
        <div class="content">
            <span class="cerrar">&times;</span>
            <h4 class="title">Añadir nuevos movimientos</h4>
            <br>
            <hr>
            <form method="post" id="insert_form" onsubmit="return Validar(this, 'concepto', 'fecha', 'cuantia')" action="<?php echo RUTA_URL?>/admin/add_movimiento">
                <label>Concepto Movimiento:</label>
                <input type="text" id="concepto" name="concepto">
                <p id="ErrorNombre"></p>

                <label>Fecha:</label>
                <input type="date" id="fecha" name="fecha">
                <p id="ErrorFecha"></p>

                <label>Cantidad:</label>
                <input type="number" step="any" id="cuantia" name="cuantia"> 
                <p id="ErrorCuantia"></p>

                <label>Tipo Movimiento:</label>
                <select name="selectMovimiento">
                <?php foreach($datos["tipos_movimiento"] as $movimiento): ?>
                    <option value="<?php echo $movimiento->Id?>"><?php echo $movimiento->Nombre?></option>
                <?php endforeach ?>
                </select>

                <label>Beca relacionada</label>
                <select name="selectBeca">
                    <option  id="enBlanco" value="" cheked></option>
                    <?php foreach($datos['tipoBeca'] as $tipoBeca): ?>
                        <option value="<?php echo $tipoBeca->Id_Beca ?>"><?php echo "Id Beca: " ?><?php echo $tipoBeca->Id_Beca ?><?php echo " - " ?><?php echo "Importe: "?><?php echo $tipoBeca->Importe ?></option>
                    <?php endforeach ?>
                </select>
                <p>***Si el movimiento que desea hacer no está relacionado a una Beca, por favor seleccione el registro en blanco.</p>

                
                <button type="submit" class="btn btn-primary" onclick="validarFormulario()">Añadir</button>
            </form> 
        </div>
    </div>  

    <h1>ECONOMIA</h1>

<div id="contenido">

    <div class="col-2">
        <input type="search" class="color_input" id="buscador" name="buscador" placeholder="Buscador" aria-label="Search" onkeyup="mod_show()">
    </div>
    <div class="col-3">
      <select id="panel_filtro" name="Tipo" onchange="mod_show()" class="form-select color_input form-select-lg mb-3" aria-label=".form-select-lg example">
      <option id="refresh" value="0" selected></option>
        <?php foreach($datos["tipos_movimiento"] as $movimiento): ?>
          <option value="<?php echo $movimiento->Id ?>"><?php echo $movimiento->Nombre ?></option>
        <?php endforeach ?>
      </select>
      <br>
    </div>

    <?php
        $total = 0;
        foreach($datos["MovimientosTotales"] as $move){
            if ($move->Nombre_TipoMov == "Ingreso"){
                $total = $total + $move->Cantidad;
            } else {
                $total = $total - $move->Cantidad;
            }
        }
        echo "<h2 class='verde'>Total: ".$total."€</h2>";
    ?>


    <input disabled id="page_controller" name="movimiento" value="0" hidden>

    <button id="abrirModal">+</button>
    <br>
    <br>
    <div id="contenido">
        <table id="tabla_gestion" class="table color_sheet table_sheet table-hover">
            <thead class="">
                <tr>
                    <th scope="col">Nº Movimiento</th>
                    <th scope="col">Tipo Movimiento</th>
                    <th scope="col">Concepto</th>
                    <th scope="col">Fecha <button type="button" name="3" value="1" onclick="mod_show(this)"><i class="fa fa-sort"></i></button></th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Id Beca</th>
                </tr>
            </thead>
            <tbody id="contenido_tabla">
               
            </tbody>
        </table>
    </div>


    <div class="Movimientos">
      <nav aria-label="Page navigation example">
        <ul id="page_panel" class="pagination justify-content-center">
            
        </ul>
      </nav>
    </div>

    <h2 id="nomaches"></h2>

    <script>
      window.onload=caja_fuerte(<?php echo json_encode($datos["MovimientosTotales"])?>, <?php echo json_encode($datos["usuarioSesion"]->Nombre)?>, <?php echo $datos["usuarioSesion"]->Id_Rol?>);
      window.onload=listar_elementos(true);
      window.onload=save_config(); // Cargar los datos de Accesibilidad
    </script>

</div>

<br>
<br>
<br>



<?php require_once RUTA_APP.'/vistas/inc/footer.php'?>