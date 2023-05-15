const agregarValores = () =>{
    let descripcion = document.querySelector("#descripcion").value;
    let costo = document.querySelector("#costo").value.replace(/[$.]/g, "");
    costo = costo.replace(",",".");

    $.ajax({
        url: 'controllers/maestroController.php?accion=agregar',
		method: 'POST',

		data: {
            descripcion:descripcion,
            costo:costo
        },

		success: function(data) {
			swal({
                title: "Movimiento Completado",
                icon: "success",
                button: "Aceptar",
            })
            .then(function() {
                window.location = "listarValores.php";
            });
        } 

	});

}

const eliminar = (div) =>{

    let id = div.parentElement.parentElement.childNodes[1].textContent;
    $.ajax({
        url: 'controllers/maestroController.php?accion=eliminar',
		method: 'POST',

		data: {
            id:id
        },

		success: function(data) {
			swal({
                title: "Eliminado",
                icon: "success",
                button: "Aceptar",
            })
            .then(function() {
                location.reload();
            });
        } 

	});
}

const editarValores = (id) => {

    let costo = document.querySelector("#costoUpdate").value.replace(/[$.]/g, "");
    costo = costo.replace(",",".");

    $.ajax({
        url: 'controllers/maestroController.php?accion=actualizar',
		method: 'POST',

		data: {
            id:id,
            descripcion:document.querySelector("#descripcionUpdate").value,
            costo:costo
        },

		success: function(data) {
			swal({
                title: "Registro Actualizado",
                icon: "success",
                button: "Aceptar",
            })
            .then(function() {
                window.location = "listarValores.php";
            });
        } 

	});

}

const parsearValor = (isUpdate) =>{
    
    let costo = "";

    if(isUpdate == false){
        costo = document.querySelector("#costo");
    }else{
        costo = document.querySelector("#costoUpdate");
    }

    let number = costo.value.replace(/[$.]/g, "");
    number = number.replace(",",".");
    let newNumber = 0;
    number = parseFloat(number);

    newNumber = number.toLocaleString('de-De', {
        style: 'decimal',
        maximumFractionDigits: 2,
        minimumFractionDigits: 0
    });

    costo.value ="$"+ newNumber;

}