function ajax(boton){
    
    // boton.id / boton.name
    //CREAREMOS UNA CONSTANTE QUE ME RECOGERA EL DATO QUE QUIERO ENVIAR (TENER EN CUENTA EL NOMBRE YA QUE SE UTILIZARA EN)
    const data = {texto : boton.id}
    
    fetch("recibir.php",{//ESPECIFICAMOS LA RUTA A LA QUE SE ENVIA
        method: 'POST',
        body: JSON.stringify(data), //CODIFICAMOS LA VARIABLE PARA ENVIARLA A PHP
        headers:{ //LE INDICAMOS AL PROGRAMA QUE TIPO DE INFORMACIÓN ENVIAMOS
            'Accept' : 'application/json',
            'Content-Type' : 'application/json',
        }
    }).then(response =>{//RECIBIMOS LA RESPUESTA EN UN OBJETO TIPO JSON
        
        return response.json();
        
    }).then(data => {
        console.log(data);

        document.getElementById("resultados").innerHTML= "<p>"+data.publicacion['escritor']+"</p>";
        
    }).catch(error => console.error(error));//EN CASO DE ERROR ME LO MUESTRA POR CONSOLA
}