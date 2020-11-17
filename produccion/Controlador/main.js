function ingresarStock(){

}


function procesar(){
    swal({
        title: "Confirmar ingreso",
        text: "Estas seguro que desea confirmar el ingreso del stock",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          window.location = 'Controlador/ingresarStock.php';
        } else {
          swal("Ingreso Cancelado!");
        }
      });
}