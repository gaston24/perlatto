
//////////////////////BUSQUEDA RAPIDA DE GUSTOS//////////////////////

function busquedaRapida() {
    var input, filter, table, tr, td, td2, i, txtValue;
    input = document.getElementById('textBox');
    filter = input.value.toUpperCase();
    table = document.getElementById("tabla");
    tr = table.getElementsByTagName('tr');
  
  
    for (i = 0; i < tr.length; i++) {
        visible = false;
        td = tr[i].getElementsByTagName("td");
  
        for (j = 0; j < td.length; j++) {
            if (td[j] && td[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
                visible = true; 
            }
        }
        if (visible === true) {
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
        }
    }
}



//////////////////////CANTIDAD DEL PEDIDO//////////////////////

function changeCantidad(){
    let cantidad = Array.from(document.getElementById("id_tabla").rows);

    let total = 0;
    cantidad.forEach(x=>{
        let valor = x.querySelectorAll('td');

            valor.forEach(function(y, z){
                if(z==3){

                    total += parseInt(y.firstChild.value);

                }
        })
    });

    // console.log(total);

    document.getElementById("cantBox").value = total;


    
}




//////////////////////ENVIO DEL PEDIDO//////////////////////

function enviarPedido(){

    var table = document.getElementById("tabla");
    var matriz = [];


    for(var i=0;  i<table.rows.length ; i++){
        // if(table.rows[i].cells[3].firstChild.value != 0){
            matriz[i] = [];
            for(var x=0; x<table.rows[0].cells.length ; x++ ){
                if(x==0){
                    var dato =  table.rows[i].cells[x].firstChild.value;    
                }else if(x==3){
                    var dato =  table.rows[i].cells[x].firstChild.value;    
                }else{
                    var dato =  table.rows[i].cells[x].innerHTML;    
                }
                matriz[i][x] = dato;
            }    
        // }    
    }


    // console.log(matriz);

    
    var suma = 0;
    var x = document.querySelectorAll("#tabla input[name='cantidad[]']");

    var i;
    for (i = 0; i < x.length; i++) {
        suma += parseInt(0+x[i].value);
    }
    
    if(suma!= 0){

        const funcAsync = async ()=>{
            try {
                const datos2 = await buscarCondicion();
                const datos3 = JSON.parse(datos2);
                
                if(datos3.condicion == 'MINIMO'){

                    if(suma < parseInt(datos3.valor)){
                        swal({
                            title: "Error!",
                            text: "Las cantidades deben tener un minimo de "+datos3.valor+" unidades pedidas!",
                            icon: "warning",
                            button: "Aceptar",
                          });
                    }else{
                        console.log("llegue");
                        postear(matriz, suc);
                    }

                }


                if(datos3.condicion == 'MULTIPLO'){

                    if(suma%parseInt(datos3.valor) != 0){
                        swal({
                            title: "Error!",
                            text: "Las cantidades deben ser multiplo de "+datos3.valor+"!",
                            icon: "warning",
                            button: "Aceptar",
                          });
                    }else{
                        console.log("llegue");
                        postear(matriz, suc);
                    }

                }


            } catch (error) {
                console.log(error);
            }
        }

        funcAsync();



    }else{
        swal({
            title: "Error!",
            text: "No hay cantidades seleccionadas!",
            icon: "warning",
            button: "Aceptar",
          });
    }


}



//////////////////////POSTEO//////////////////////

function postear(matriz, suc) {

    $.ajax({
        url: 'Controlador/cargarPedido.php',
		method: 'POST',
		data: {
            matriz: matriz,
            suc: suc
        },

		success: function(data) {
			swal({
                title: "Pedido cargado exitosamente!",
                text: "Numero de pedido: "+data,
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


function modificarEstado(nroPedido){

    estado = document.getElementById("estadoActual").value;
    // console.log(estado, nroPedido);
    
    $.ajax({
        url: 'Controlador/modificarEstadoPedido.php',
		method: 'POST',
		data: {
            nroPedido: nroPedido, 
            estado: estado

        },

		success: function(data) {
			swal({
                title: "Estado del pedido modificado!",
                text: "Numero de pedido: "+data,
                icon: "success",
                button: "Aceptar",
              })
              .then(function() {
                window.location = "pendientes.php";
            })
            ;
            
        } 
 
    });
    
}


function modificarEstadoMasivo(){
    var id = document.querySelectorAll("input[id ='pedidoActua']:checked");
    var pedidos = [];

    for(x=0;x<id.length;x++){
        pedidos.push(id[x].value);
    }

    var estado = document.getElementById("estadoActual").value;

    // console.log(pedidos);
    // console.log(estado);

    $.ajax({
        url: 'Controlador/modificarEstadoPedidoMasivo.php',
		method: 'POST',
		data: {
            pedidos : pedidos, 
            estado: estado

        },

		success: function(data) {
			swal({
                title: "El estado de los pedidos fueron modificados!",
                text: "Pedidos: "+data,
                icon: "success",
                button: "Aceptar",
              })
              .then(function() {
                window.location = "pendientes.php";
            })
            ;
            
        } 
 
    });
}




function modificarPedido(nroPedido){

    var table = document.getElementById("pendientes");
    var matriz = [];


    for(var i=0;  i<table.rows.length ; i++){
        // if(table.rows[i].cells[3].firstChild.value != 0){
            matriz[i] = [];
            for(var x=0; x<table.rows[0].cells.length ; x++ ){
                if(x==6){
                    var dato =  table.rows[i].cells[x].firstChild.value;        
                }else{
                    var dato =  table.rows[i].cells[x].innerHTML;    
                }
                matriz[i][x] = dato;
            }    
        // }    
    }


    estado = document.getElementById("estadoActual").value;
    console.log(estado, nroPedido, matriz);


    
    $.ajax({
        url: 'Controlador/modificarPedido.php',
		method: 'POST',
		data: {
            nroPedido: nroPedido, 
            estado: estado, 
            matriz: matriz

        },

		success: function(data) {
			swal({
                title: "Estado del pedido modificado!",
                text: "Numero de pedido: "+data,
                icon: "success",
                button: "Aceptar",
              })
              .then(function() {
                window.location = "pendientes.php";
            })
            ;
            
        } 
 
    });
    
}


function insertarTachosPedido(nroPedido) {
	
	$.ajax({
        url: 'Controlador/confirmarTachosPedido.php',
		method: 'POST',
		data: {
            nroPedido: nroPedido
        },

		success: function(data) {
			swal({
                title: "Pedido actualizado exitosamente!",
                text: "Numero de pedido: "+nroPedido,
                icon: "success",
                button: "Aceptar",
              })
              .then(function() {
                window.location = "pendientes.php";
            })
            ;
            
        } 
 
	});
	
}

function buscarCondicion() {
	
	var condicion = $.ajax({
        url: 'Controlador/condicionPedidos.php',
		method: 'GET',
		data: {

        },

		success: function(data) {
            condiciones = JSON.parse(data);         
			return condiciones;
        } 
 
	});

    return condicion;
	
}