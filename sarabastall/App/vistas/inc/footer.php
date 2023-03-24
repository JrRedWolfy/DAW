

        <div class="panel_accesibilidad">
            <div id="panel_accesibilidad" class="accesibilidad hide">
                <button onclick="size_font('+')" class="accesBtn font_size">A+</button>
                    <button onclick="size_font('-')" class="accesBtn font_size">A-</button>
                    <button onclick="size_font('=')" class="accesBtn font_size">A</button>
                    <button onclick="color_web('')" class="accesBtn contraste low-contrast"></button>
                    <button onclick="color_web('A')" class="accesBtn contraste alternative"></button>
                    <button onclick="color_web('H')" class="accesBtn contraste high-contrast"></button>
            </div>
            <button id="acces_butt" class="accesBtn acces_butt" onclick="show_accesibility(true);"><i class="fa fa-universal-access"></i></button>
        </div>   
    
    <footer class="text-center text-lg-start bg-light text-muted fixed-bottom">
    
        <div class="text-center p-2" style="background-color: rgba(0, 0, 0, 0.05);">
            &#169; 2023 Copyright:
            <a class="text-reset fw-bold" href="https://fundacionsarabastall.org" target="_blank">
                Fundacion Sarabastall 
            </a>
        </div>

    </footer>

    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js" integrity="sha384-SlE991lGASHoBfWbelyBPLsUlwY1GwNDJo3jSJO04KZ33K2bwfV9YBauFfnzvynJ" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="<?php echo RUTA_URL_STATIC?>/js/main.js"></script>

</body>
</html>