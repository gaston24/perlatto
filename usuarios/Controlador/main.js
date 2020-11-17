//////////////////////ENVIO DEL USUARIO//////////////////////

function newUser(){

    var matrizUsuario = [];
    var diasEntrega = [];

    var nroLocal = document.getElementById("nroLocal").value;
    var descLocal = document.getElementById("descLocal").value;
    var cuit = document.getElementById("cuit").value;
    var nombreContacto = document.getElementById("nombreContacto").value;
    var direccion = document.getElementById("direccion").value;
    var localidad = document.getElementById("localidad").value;
    var provincia = document.getElementById("provincia").value;
    var email = document.getElementById("email").value;
    var telefono1 = document.getElementById("telefono1").value;
    var telefono2 = document.getElementById("telefono2").value;
    var user = document.getElementById("user").value;
    var pass = document.getElementById("pass").value;

    matrizUsuario[0] = nroLocal;
    matrizUsuario[1] = descLocal;
    matrizUsuario[2] = cuit;
    matrizUsuario[3] = nombreContacto;
    matrizUsuario[4] = direccion;
    matrizUsuario[5] = localidad;
    matrizUsuario[6] = provincia;
    matrizUsuario[7] = email;
    matrizUsuario[8] = telefono1;
    matrizUsuario[9] = telefono2;
    matrizUsuario[10] = user;
    matrizUsuario[11] = pass;


    var lunes = document.getElementById("chkLunes").checked;
    var martes = document.getElementById("chkMartes").checked;
    var miercoles = document.getElementById("chkMiercoles").checked;
    var jueves = document.getElementById("chkJueves").checked;
    var viernes = document.getElementById("chkViernes").checked;
    var sabado = document.getElementById("chkSabado").checked;
    var domingo = document.getElementById("chkDomingo").checked;

    if(lunes == true){diasEntrega[0] = 1;}else{diasEntrega[0] = 0}
    if(martes == true){diasEntrega[1] = 1;}else{diasEntrega[1] = 0}
    if(miercoles == true){diasEntrega[2] = 1;}else{diasEntrega[2] = 0}
    if(jueves == true){diasEntrega[3] = 1;}else{diasEntrega[3] = 0}
    if(viernes == true){diasEntrega[4] = 1;}else{diasEntrega[4] = 0}
    if(sabado == true){diasEntrega[5] = 1;}else{diasEntrega[5] = 0}
    if(domingo == true){diasEntrega[6] = 1;}else{diasEntrega[6] = 0}

    // console.log(diasEntrega);



    var vacio = 0;

    for (var valor of matrizUsuario) {
        if(valor == null || valor == ''){
            vacio = 1;
        }
      }

    

    if(vacio == 0){
        nuevoUsuario(matrizUsuario, diasEntrega);
    }else{
        swal({
            title: "Error!",
            text: "Faltan cargar datos!",
            icon: "warning",
            button: "Aceptar",
          });
    }


}



//////////////////////POSTEO//////////////////////

function nuevoUsuario(matrizUsuario, diasEntrega) {
	
	$.ajax({
        url: 'Controlador/cargarUsuario.php',
		method: 'POST',
		data: {
            matrizUsuario: matrizUsuario, 
            diasEntrega : diasEntrega
        },

		success: function(data) {
			swal({
                title: "Nuevo usuario cargado!",
                text: "Nuevo usuario y local cargado: "+data,
                icon: "success",
                button: "Aceptar",
              })
              .then(function() {
                window.location = "../inicio.php";
            })
            ;
            
        } 
 
	});
	
}








//////////////////////ENVIO DEL USUARIO PARA MODIFICAR//////////////////////

function modUser(){

    var matrizUsuario = [];
    var diasEntrega = [];

    var nroLocal = document.getElementById("nroLocal").value;
    var descLocal = document.getElementById("descLocal").value;
    var cuit = document.getElementById("cuit").value;
    var nombreContacto = document.getElementById("nombreContacto").value;
    var direccion = document.getElementById("direccion").value;
    var localidad = document.getElementById("localidad").value;
    var provincia = document.getElementById("provincia").value;
    var email = document.getElementById("email").value;
    var telefono1 = document.getElementById("telefono1").value;
    var telefono2 = document.getElementById("telefono2").value;
    var user = document.getElementById("user").value;
    var pass = document.getElementById("pass").value;
    var estado = document.getElementById("estado").value;

    matrizUsuario[0] = nroLocal;
    matrizUsuario[1] = descLocal;
    matrizUsuario[2] = cuit;
    matrizUsuario[3] = nombreContacto;
    matrizUsuario[4] = direccion;
    matrizUsuario[5] = localidad;
    matrizUsuario[6] = provincia;
    matrizUsuario[7] = email;
    matrizUsuario[8] = telefono1;
    matrizUsuario[9] = telefono2;
    matrizUsuario[10] = user;
    matrizUsuario[11] = pass;
    matrizUsuario[12] = estado;


    
    var lunes = document.getElementById("chkLunes").checked;
    var martes = document.getElementById("chkMartes").checked;
    var miercoles = document.getElementById("chkMiercoles").checked;
    var jueves = document.getElementById("chkJueves").checked;
    var viernes = document.getElementById("chkViernes").checked;
    var sabado = document.getElementById("chkSabado").checked;
    var domingo = document.getElementById("chkDomingo").checked;

    if(lunes == true){diasEntrega[0] = 1;}else{diasEntrega[0] = 0}
    if(martes == true){diasEntrega[1] = 1;}else{diasEntrega[1] = 0}
    if(miercoles == true){diasEntrega[2] = 1;}else{diasEntrega[2] = 0}
    if(jueves == true){diasEntrega[3] = 1;}else{diasEntrega[3] = 0}
    if(viernes == true){diasEntrega[4] = 1;}else{diasEntrega[4] = 0}
    if(sabado == true){diasEntrega[5] = 1;}else{diasEntrega[5] = 0}
    if(domingo == true){diasEntrega[6] = 1;}else{diasEntrega[6] = 0}

    var vacio = 0;

    for (var valor of matrizUsuario) {
        if(valor == null || valor == ''){
            vacio = 1;
        }
      }

    

    if(vacio == 0){
        modificarUsuario(matrizUsuario, diasEntrega);
        console.log(diasEntrega);
    }else{
        swal({
            title: "Error!",
            text: "Faltan cargar datos!",
            icon: "warning",
            button: "Aceptar",
          });
    }


}



//////////////////////POSTEO//////////////////////

function modificarUsuario(matrizUsuario, diasEntrega) {
	
	$.ajax({
        url: 'Controlador/modificarUsuario.php',
		method: 'POST',
		data: {
            matrizUsuario: matrizUsuario, 
            diasEntrega: diasEntrega
        },

		success: function(data) {
			swal({
                title: "Usuario modificado!",
                text: "Datos cargados: "+data,
                icon: "success",
                button: "Aceptar",
              })
              .then(function() {
                window.location = "usuarioListar.php";
            })
            ;
            
        } 
 
	});
	
}