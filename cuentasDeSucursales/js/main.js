const MovimientoDeSucursal = (idTipo ) => {
    let nroSucursal = document.querySelector("#nroSucursal").value;
    let optionSucursal = document.querySelector("#nroSucursal");
    let nombreSucursal = optionSucursal.options[optionSucursal.selectedIndex].text;
    let tipoDeMovimiento = document.querySelector("#tipoMovimiento").value ;
    let importe = document.querySelector("#importe").value;
    let observacion = document.querySelector("#observacion").value;
    
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
            franquiciaFabrica:idTipo
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

