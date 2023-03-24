// TODO REFERENTE A VENTANAS MODALES
  // Ventana modal
  let modal = document.getElementById("ventanaModal");

  // Botón que abre el modal
  let boton = document.getElementById("abrirModal");

  // Hace referencia al span que tiene la X que cierra la ventana
  let span = document.getElementsByClassName("cerrar")[0];

  // Cuando el usuario hace click en el botón, se abre la ventana Modal
  if (boton){
    boton.addEventListener("click",function() {
      modal.style.display = "block";
    });
  }

  // Si el usuario hace click en la x, la ventana se cierra
  if (span){
    span.addEventListener("click",function() {
      modal.style.display = "none";
    });
  }

  // Si el usuario hace click fuera de la ventana, se cierra.
  window.addEventListener("click",function(event) { //Window es una propiedad que hace referencia a la ventana actual
    if (event.target == modal) {
      modal.style.display = "none";
    }
  });

//VENTANA MODAL DE ALUMNOS
  // Ventana modal
  let modalAlu = document.getElementById("ModalAlumno");

  // Botón que abre el modal
  let botonAlu = document.getElementById("AddAlumno");

  // Hace referencia al span que tiene la X que cierra la ventana
  let spanAlu = document.getElementsByClassName("cerrar")[0];

  // Cuando el usuario hace click en el botón, se abre la ventana Modal
  if (botonAlu){
    botonAlu.addEventListener("click",function() {
      modalAlu.style.display = "block";
    });
  }

  // Si el usuario hace click en la x, la ventana se cierra
  if (spanAlu){
    spanAlu.addEventListener("click",function() {
      modal.style.display = "none";
    });
  }

  // Si el usuario hace click fuera de la ventana, se cierra.
  window.addEventListener("click",function(event) { //Window es una propiedad que hace referencia a la ventana actual
    if (event.target == modalAlu) {
      modalAlu.style.display = "none";
    }
  });




  //Ventana modal para añadir NUEVAS CIUDADES
  let modalC = document.getElementById("MODAlciudad");

  // Botón que abre el modal
  let btn = document.getElementById("botonCiudad");

  // Hace referencia al span que tiene la X que cierra la ventana
  let span2 = document.getElementsByClassName("cerrar")[1];

  // Cuando el usuario hace click en el botón, se abre la ventana Modal
  if (btn){
    btn.addEventListener("click",function() {
      
      modalC.style.display = "block";
    });
  }

  // Si el usuario hace click en la x, la ventana se cierra

    if (span2){
      span2.addEventListener("click",function() {
        modalC.style.display = "none";
      });
    }

    // Si el usuario hace click fuera de la ventana, se cierra.
    window.addEventListener("click",function(event) { //Window es una propiedad que hace referencia a la ventana actual
      if (event.target == modalC) {
        modalC.style.display = "none";
      }
    });


//TODO LO REFERENTE A FORMULARIOS

//Importe negativo
function importeNoNegativo() {
  // Coge el value del importe
  let x = document.getElementById("importe").value;

  // Si x es negativo la cantidad es no valida
  let text;

  if (isNaN(x) || x < 0) {
    text = "Cantidad introducida no valida";
    importe.style.borderColor = "red";
    return false;
  } else {
    importe.style.borderColor = "green";
    text = "Cantidad introducida valida";
  }
  document.getElementById("ErrorImporte").innerHTML = text;
}


//Campos vacios 

function Validar() {
  params = Validar.arguments;
  f = params[0];
  for (let i = 1, caracteres = params.length; i < caracteres; i++){  //Bucle de los campos
    if (f[params[i]].value == ""){ //Si el campo esta vacio, sale el alert con el nombre del campo a rellenar
      //alert("Debe rellenar obligatoriamente el campo: " + params[i]);
      // params[i].style.borderColor = "red";
      return false;
     }    
   }
}

//Campo vacio de nombre de curso
function textoVacioNombreCurso(){
  let x = document.getElementById("nombreCurso").value;
  let text;

  if(x == ""){
    nombreCurso.style.borderColor = "red";
    text = "Rellena el campo";
  }
  else{
    nombreCurso.style.borderColor = "green";
    text = "Esta bien";
  }
  document.getElementById("ErrorNombre").innerHTML = text;
}

//Campo vacio de nombre del profesor
function textoVacioNombreProfesor(){
  let x = document.getElementById("profesor").value;
  let text;

  if(x == ""){
    profesor.style.borderColor = "red";
    text = "Rellena el campo";
  }
  else{
    profesor.style.borderColor = "green";
    text = "Esta bien";
  }
  document.getElementById("ErrorProfesor").innerHTML = text;
}

//Campo de fecha vacia
function textoVacioFecha(){
  let x = document.getElementById("fechaCurso").value;
  let text;

  if(x == ""){
    fechaCurso.style.borderColor = "red";
    text = "Rellena el campo";
  }
  else{
    fechaCurso.style.borderColor = "green";
    text = "Esta bien";
  }
  document.getElementById("ErrorFecha").innerHTML = text;
}


//Función con todas las funciones juntas para que siga un orden
function todos(){
  textoVacioNombreCurso();
  textoVacioNombreProfesor();
  textoVacioFecha();
  importeNoNegativo();
}


function validarFormulario(){
  const inputs = document.getElementById("insert_form").elements; //id del formulario

  // Bucle del form a los distintos inputs
  for (let i = 0; i < inputs.length; i++) {
    switch(inputs[i].type){
      case "text": //tipo de dato
        if(inputs[i].value == ""){ //si esta vacio
          inputs[i].classList.remove("formBien");
          inputs[i].classList.add("formMal");
        }else{
          inputs[i].classList.remove("formMal");
          inputs[i].classList.add("formBien");
        }
        break;
      
      case "date": //tipo de dato
        if(inputs[i].value == ""){
          inputs[i].classList.remove("formBien");
          inputs[i].classList.add("formMal");
        }else{  
          inputs[i].classList.remove("formMal");
          inputs[i].classList.add("formBien");
        }
        break;

      case "number": //tipo de dato
        if(inputs[i].value == ""){
          inputs[i].classList.remove("formBien");
          inputs[i].classList.add("formMal");
        }else{
          inputs[i].classList.remove("formMal");
          inputs[i].classList.add("formBien");
        }
        break;
    }
  }
}

// FUNCIONES AUXILIARES PARA LA GESTIÓN

function place_id(Id){
  document.getElementById("Id_Eliminar").setAttribute("value", Id);
}

function place_idAceptar(Id){
  document.getElementById("Id_Aceptar").setAttribute("value", Id);
}

function place_idRechazar(Id){
  document.getElementById("Id_Rechazar").setAttribute("value", Id);
}

function place_idUser(Id){
  document.getElementById("Id_User").setAttribute("value", Id);
}


// PAGINACION

function go_page(elemen){

  page = elemen.name;
  page = parseInt(page)-1;

  document.getElementById("page_controller").value = page;
  
  listar_elementos();
  control_paginacion();

}


function siguiente(){
  page = document.getElementById("page_controller").value;
  page = parseInt(page)+1;
  
  document.getElementById("page_controller").value = page;
  
  listar_elementos();
  control_paginacion();
}

function anterior(){

  page = document.getElementById("page_controller").value;
  page = parseInt(page)-1;

  document.getElementById("page_controller").value = page;
  
  listar_elementos();
  control_paginacion();
}


//BUSCADOR
function buscar(){
  search = document.getElementById("buscador").value.toUpperCase(); // Toma el contenido del buscador y lo reescribe en mayusculas para hacer la posterior Comparacion

  //alert(search);

  if (search != ""){ // Comprueba que se este buscando algo (Quizas habria que hacer un trim(), puesto que no he comprobado como lee espacios)
    for (i = 0; i < arrayMaestro.length; i++){
      arraySon = Object.values(arrayMaestro[i]);
      let find = false;
  
      for (e = 0; e < arraySon.length; e++){// Contenido de la columna
        find = false;
  
        if (String(arraySon[e]).toUpperCase().indexOf(search) > -1){
          find = true;
          break;
        }
      }
      
      if (find == false){
        arrayMaestro.splice(i, 1);
        i = i-1;
      }
      
    }
  }
}		

function ordenaras(flag){

  orden = flag.value;
  colum = flag.name;

  if (orden == "1"){
    flag.value = "0";
  } else {
    flag.value = "1";
  }

  arrayOrden = [];

  for (i = 0; i < arrayMaestro.length; i++){
    if (i == 0){
      arrayOrden.push(arrayMaestro[i]);
    } else {
      arraySon = Object.values(arrayMaestro[i]);
      
      for (e = 0; e < arrayOrden.length; e++){
        arrayComparacion = Object.values(arrayOrden[e]); 
        comparacion = [arrayComparacion[colum], arraySon[colum]];
        resultado = comparacion.sort((a, b) => a < b);

        if (resultado[0] == arraySon[colum]){
          
          arrayOrden.splice(e, 0, arrayMaestro[i]); // El 0 es una instruccion que indica Insertar, si fuese un 1 entonces Reemplaza. La e indica el index el el que interactuar
          break;
        } else {
          if (e == arrayOrden.length-1){
            arrayOrden.push(arrayMaestro[i]);
            
            e = e+1;
          }
        }
      }
    }
  }
  if (orden == "0"){
    arrayOrden = arrayOrden.reverse();
  }

  arrayMaestro = arrayOrden;
  // Obtener de alguna forma Columna Comparada 
}


// FUNCION DE FILTRADO

function filtrar(){
  arrayMaestro = []; // Vaciamos el Array Maestro

  // alert(arrayMaestro); Nos aseguramos de que el ArrayMaestro este vacio
  elemen = document.getElementById("panel_filtro");
  let filtro = elemen.options[elemen.selectedIndex].text; // Nombre a filtrar
  //alert(filtro);

  if (filtro == ""){ // Si no hay filtro seleccionado se toma los datos del array Original
    arrayMaestro = listado.slice();
  } else {
    for (i = 0; i < listado.length; i++){ // Bucle que recorre todos los items guardados en el array Original

      if (Object.values(listado[i])[1] == filtro){ // El 1 indica la columna que esta filtrando, en otras gestiones puede que no sea el 1, en cuyo caso 2 opciones, Moverlo, o indicar la columna por hidden
        arrayMaestro.push(listado[i]); // Agrega el item que pase el filtro
        // alert(Object.values(listado[i])); //Muestra los items que pasan el filtro
      }
    }
  }
  //alert(arrayMaestro); //Muestra el array resultante del filtro
}	

function mod_show(flag = false){ // A cualquier cambio en la busqueda se llama a esta funcionç
  if(document.getElementById("panel_filtro")){
    filtrar(); // Primero se filtra el array
  } else {
    arrayMaestro = listado.slice();
  }
  buscar(); // Entonces se compara el resultado 
  if (flag != false){
    ordenaras(flag);
  }
  page_maker();
  listar_elementos(false);// Por ultimo se paginan los resultados
  // Se le envia con un parametro falso indicando que no es una ejecucion automatica. La cual se hace al cargar la pagina
}

// REFERENTE ACCESIBILIDAD

function show_accesibility(accion){

  panel = document.getElementById("panel_accesibilidad");

  if (accion){
    panel.classList.remove("hide");
    panel.classList.add("show");
    document.getElementById("acces_butt").setAttribute("onclick", "show_accesibility(false)");
  } else {
    panel.classList.remove("show");
    panel.classList.add("hide");
    document.getElementById("acces_butt").setAttribute("onclick", "show_accesibility(true)");
  }
}