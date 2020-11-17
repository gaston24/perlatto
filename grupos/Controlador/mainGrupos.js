//////////////////////ENVIO DEL GRUPO//////////////////////

function newGrupo(){

    var matrizGrupo = [];

    var codGrupo = document.getElementById("codGrupo").value;
    var descGrupo = document.getElementById("descGrupo").value;


    matrizGrupo[0] = codGrupo;
    matrizGrupo[1] = descGrupo;


    var vacio = 0;

    for (var valor of matrizGrupo) {
        if(valor == null || valor == ''){
            vacio = 1;
        }
      }

    

    if(vacio == 0){
        nuevoGrupo(matrizGrupo);
    }else{
        swal({
            title: "Error!",
            text: "Faltan cargar datos!",
            icon: "warning",
            button: "Aceptar",
          });
    }


}



//////////////////////NUEVO GRUPO//////////////////////

function nuevoGrupo(matrizGrupo) {
	
	$.ajax({
        url: 'Controlador/cargarGrupo.php',
		method: 'POST',
		data: {
            matrizGrupo: matrizGrupo
        },

		success: function(data) {
			swal({
                title: "Nuevo grupo cargado!",
                text: data,
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








//////////////////////ELIMINAR//////////////////////

function eliminarGrupo(codGrupo){
    console.log(codGrupo);
	swal({
		  title: "Esta seguro que desea eliminar el grupo?",
		  text: "El grupo sera eliminado!",
		  icon: "warning",
		  buttons: true,
		  dangerMode: true,
		})
		.then((willDelete) => {
		  if (willDelete) {

            $.ajax({
                url: 'Controlador/eliminarGrupo.php',
                method: 'POST',
                data: {
                    codGrupo: codGrupo
                }
         
            });


		    swal("Grupo eliminado!", {
          icon: "success",
          text: data,
		    }).then(function() {
                window.location = "../inicio.php";
            });
		  } else {
		    swal("Grupo NO eliminado!");
		  }
		});
}









