const MovimientoDeSucursal = (idTipo ) => {
    let nroSucursal = document.querySelector("#nroSucursal").value;
    let optionSucursal = document.querySelector("#nroSucursal");
    let nombreSucursal = optionSucursal.options[optionSucursal.selectedIndex].text;
    let tipoDeMovimiento = document.querySelector("#tipoMovimiento").value ;
    let cantidad = document.querySelector("#cantidad").value;
    let observacion = document.querySelector("#observacion").value;
    let selectMovimiento = document.querySelector("#tipoMovimiento");
    let cantidadTachos = document.querySelector("#cantidadTachos").value;
    let cantidadKilos = document.querySelector("#cantidadKilos").value;
    let fecha = document.querySelector("#fecha").value;

 

    if(selectMovimiento.value == "salida_tachos"){
        cantidad = cantidadTachos;
        if(cantidadTachos == "" || cantidadKilos == "" || cantidadTachos < 1 || cantidadKilos < 1 ){
            swal({
                title: "Error",
                text: "Datos erroneos, debe ingresar valroes mayores a 0",
                icon: "error",
                button: "Aceptar",
            })
            return;
        }
    }

    $.ajax({
        url: 'controllers/cuentaController.php',
		method: 'POST',

		data: {
            nroSucursal: nroSucursal,
            tipoDeMovimiento:tipoDeMovimiento,
            cantidad:cantidad,
            observacion:observacion,
            franquiciaFabrica:idTipo,
            cantidadKilos:cantidadKilos,
            fecha:fecha
        },

		success: function(data) {
			swal({
                title: "Movimiento Completado",
                icon: "success",
                button: "Aceptar",
            })
            .then(function() {
                window.location = "listar.php?idSucursal=" + nroSucursal+"&nombreSucursal="+nombreSucursal+"&idTipo="+idTipo;
            });
        } 

	});

}

// document.querySelector("#importe").addEventListener("change", (function() {

//     let importe = document.querySelector("#importe").value;

//     importe = importe.replace(",",".");
//     importe = parseFloat(importe);

//     document.getElementById('importe').value = importe.toLocaleString('de-DU', {
//         style: 'decimal',
//         maximumFractionDigits: 2,
//         minimumFractionDigits: 2
//     });


// }))

const comprobarTacho = () => {
    let selectMovimiento = document.querySelector("#tipoMovimiento");
    let divCantidadTachos = document.querySelector("#divCantidadTachos");
    let divCantidadKilos= document.querySelector("#divCantidadKilos");
    let cantidadTachos = document.querySelector("#cantidadTachos");
    let cantidadKilos = document.querySelector("#cantidadKilos");
    let divCantidad = document.querySelector("#divCantidad");
    if(selectMovimiento.value == "salida_tachos"){
        divCantidadTachos.hidden = false;
        divCantidadKilos.hidden = false;
        divCantidad.hidden = true;

    }else{
        cantidadTachos.value = "";
        cantidadKilos.value = "";
        divCantidadTachos.hidden = true;
        divCantidadKilos.hidden = true;
        divCantidad.hidden = false;
        
    }
    // console.log(selectMovimiento.value);
}

document.addEventListener("DOMContentLoaded", function(event) {
    comprobarTacho();
})

