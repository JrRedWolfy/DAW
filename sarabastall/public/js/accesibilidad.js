
let old = "";

function color_web(type){
    document.cookie = "contraste="+type; 
    
    // Fondo
    if (document.getElementById('fondo_color')){
        document.getElementById('fondo_color').classList.replace("color_fondo"+old, "color_fondo"+type);
    }
  
    // Tablas
    if (document.getElementById('tabla_gestion')){
        document.getElementById('tabla_gestion').classList.replace("color_sheet"+old, "color_sheet"+type);
    }

    // Inputs
    inputs = document.getElementsByTagName('input');
    selects = document.getElementsByTagName('select');

    for(i = 0; i < inputs.length; i++){
        inputs[i].classList.replace("color_input"+old, "color_input"+type);
    }
    for(i = 0; i < selects.length; i++){
        selects[i].classList.replace("color_input"+old, "color_input"+type);
    }

  old = type;
}

function size_font(order){

    body = document.getElementsByTagName('body')[0];
    table = document.getElementsByTagName('table')[0];

    switch (order){
      case '+':
        body.style.fontSize = '1.9em';
        table.style.fontSize = '1.9em';
        break;

      case '-':
        body.style.fontSize = '0.7em';
        break;

      case '=':
        body.style.fontSize = '1em';
        break;
    }
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
        let c = ca[i];
        
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    
    return "";
}


function save_config(){
    let contraste = getCookie('contraste');
    color_web(contraste);
}