const MovimientoDeSucursal = (idTipo ) => {
    let nroSucursal = document.querySelector("#nroSucursal").value;
    let optionSucursal = document.querySelector("#nroSucursal");
    let nombreSucursal = optionSucursal.options[optionSucursal.selectedIndex].text;
    let tipoDeMovimiento = document.querySelector("#tipoMovimiento").value ;
    let importe = document.querySelector("#importe").value;
    let observacion = document.querySelector("#observacion").value;
    let selectMovimiento = document.querySelector("#tipoMovimiento");
    let cantidadTachos = document.querySelector("#cantidadTachos").value;
    let cantidadKilos = document.querySelector("#cantidadKilos").value;

    if(selectMovimiento.value == "salida_tachos"){
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
    

    importe = importe.replace(".","");
    importe = importe.replace(",",".");

    $.ajax({
        url: 'controllers/cuentaController.php',
		method: 'POST',

		data: {
            nroSucursal: nroSucursal,
            tipoDeMovimiento:tipoDeMovimiento,
            importe:importe,
            observacion:observacion,
            franquiciaFabrica:idTipo,
            cantidadTachos:cantidadTachos,
            cantidadKilos:cantidadKilos
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

document.querySelector("#importe").addEventListener("change", (function() {

    let importe = document.querySelector("#importe").value;

    importe = importe.replace(",",".");
    importe = parseFloat(importe);

    document.getElementById('importe').value = importe.toLocaleString('de-DU', {
        style: 'decimal',
        maximumFractionDigits: 2,
        minimumFractionDigits: 2
    });


}))

const comprobarTacho = () => {
    let selectMovimiento = document.querySelector("#tipoMovimiento");
    let divCantidadTachos = document.querySelector("#divCantidadTachos");
    let divCantidadKilos= document.querySelector("#divCantidadKilos");
    let cantidadTachos = document.querySelector("#cantidadTachos");
    let cantidadKilos = document.querySelector("#cantidadKilos");
    if(selectMovimiento.value == "salida_tachos"){
        divCantidadTachos.hidden = false;
        divCantidadKilos.hidden = false;

    }else{
        cantidadTachos.value = "";
        cantidadKilos.value = "";
        divCantidadTachos.hidden = true;
        divCantidadKilos.hidden = true;
    }
    // console.log(selectMovimiento.value);
}

document.addEventListener("DOMContentLoaded", function(event) {
    comprobarTacho();
})

