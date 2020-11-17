


function enviarPedido(){
    swal({
        title: "Pedido cargado!",
        text: "Pedido Nro: 00001234",
        icon: "success",
        button: "Aceptar",
      }).then(function() {
        location.href='../inicio.php';
    })
    ;

      
}