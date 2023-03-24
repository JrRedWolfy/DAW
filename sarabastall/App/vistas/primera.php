<?php require_once RUTA_APP.'/vistas/inc/header_no_login.php'?>

<div id="menuFondo">
    <div class="row d-flex justify-content-center text-center " >
        <div class="titulosPrincipales">
            <h1>
                <span class="titulo1">¿Quienes    </span>
                <span class="titulo2">Somos?</span>
            </h1>
        </div>

        <br>

        <div class="contenido">
            <div>
                <p>Pequeña ONG española, que nace y trabaja en la provincia de Zaragoza, en Caspe y su Comarca, y desarrollamos
                 proyectos de cooperación en Asia.</p>
            </div>
            
            <div>
                <p>En 1983, un grupo de jóvenes empezamos a realizar campamentos de verano para niños y niñas de la zona,
                en el Pirineo aragonés. Ampliaron los proyectos y, además de los campamentos, comenzamos a realizar actividades medioambientales, 
                solidarias y culturales. La cual surgió la Asociación Sarabastall en un referente de participación social y voluntariado.</p>
            </div>

            <div>
                <p>Cuando nuestros proyectos de cooperación comienzan a crecer, Sarabastall se organiza en dos entidades:</p>
            </div>

            <div id="div_asociacion_fundacion">
                <p><strong>-<u>ASOCIACIÓN SARABASTALL</u></strong> : Se encarga de desarrollar actividades culturales, de animación y campamentos de verano.</p>
            </div>

            <div id="div_asociacion_fundacion">
                <p><strong>-<u>FUNDACIÓN SARABASTALL. ONG</u></strong> : Inscrita en el Registro de la DGA con nº 319(I) según Orden publicada en el BOA del 16 de agosto de 2011, y
                 cuyo objeto es desarrollar proyectos de cooperación en países en vías de desarrollo, y realizar actividades de captación de fondos.</p>
            </div>

        </div>
    </div>

    <a id="acceder_sesion" class="btn btn-primary me-md-2" type="button" href="<?php echo RUTA_URL ?>/login">ACCEDER</a>

</div>

<?php require_once RUTA_APP.'/vistas/inc/footer.php'?>