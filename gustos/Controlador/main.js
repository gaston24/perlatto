//////////////////////ENVIO DEL GUSTO//////////////////////

function newGusto(){

    var matrizGusto = [];

    var codGrupo = document.getElementById("codGrupo").value;
    var codGusto = document.getElementById("codGusto").value;
    var descGusto = document.getElementById("descGusto").value;
    
    matrizGusto[0] = codGrupo;
    matrizGusto[1] = codGusto;
    matrizGusto[2] = descGusto;
    

    var vacio = 0;

    for (var valor of matrizGusto) {
        if(valor == null || valor == ''){
            vacio = 1;
        }
      }

    

    if(vacio == 0){
        nuevoGusto(matrizGusto);
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

function nuevoGusto(matrizGusto) {
	
	$.ajax({
        url: 'Controlador/cargarGusto.php',
		method: 'POST',
		data: {
            matrizGusto: matrizGusto
        },

		success: function(data) {
			swal({
                title: "Nuevo gusto cargado!",
                text: data,
                icon: "success",
                button: "Aceptar",
              })
              .then(function() {
                window.location = "gustoListar.php";
            })
            ;
            
        } 
 
	});
	
}








//////////////////////ENVIO DEL GUSTO MODIFICAR//////////////////////

function modGusto(gustoOriginal){

    var matrizGustoMod = [];

    // var gustoOriginal = document.getElementById("gustoOriginal").value;
    var codGrupo = document.getElementById("codGrupo").value;
    var codGusto = document.getElementById("codGusto").value;
    var descGusto = document.getElementById("descGusto").value;
    var estado = document.getElementById("estado").value;
    
    matrizGustoMod[0] = gustoOriginal;
    matrizGustoMod[1] = codGrupo;
    matrizGustoMod[2] = codGusto;
    matrizGustoMod[3] = descGusto;
    matrizGustoMod[4] = estado;

    var vacio = 0;

    for (var valor of matrizGustoMod) {
        if(valor == null || valor == ''){
            vacio = 1;
        }
      }

    

    if(vacio == 0){
        modificarGusto(matrizGustoMod);
    }else{
        swal({
            title: "Error!",
            text: "Faltan cargar datos!",
            icon: "warning",
            button: "Aceptar",
          });
    }


}



//////////////////////MODIFICAR//////////////////////

function modificarGusto(matrizGustoMod) {
	
	$.ajax({
        url: 'Controlador/modificarGusto.php',
		method: 'POST',
		data: {
            matrizGustoMod: matrizGustoMod
        },

		success: function(data) {
			swal({
                title: "Gusto modificado",
                text: data,
                icon: "success",
                button: "Aceptar",
              })
              .then(function() {
                window.location = "gustoListar.php";
            })
            ;
            
        } 
 
	});
	
}