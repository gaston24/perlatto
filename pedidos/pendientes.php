<?php 

session_start(); 
if(!isset($_SESSION['username'])){
	header("Location:login.php");
}else{

    $user = $_SESSION['username'];
    $suc = $_SESSION['nroSuc'];

    include __DIR__."/../Class/pedidos.php";

    $pendientes = new Pedido();
    $listado = $pendientes->pendientesAbiertos($suc);

?> 
<?php include __DIR__."/../Vista/head_0.php";   ?>
<title>Perlatto - Pendientes</title>
<?php include __DIR__."/../Vista/head.php";   ?>

<div class="container mt-2 mb-2">

<div class="row">
<div class="col"></div>
  
  <div class="col">
    <div class="form-group">
        <label for="exampleFormControlSelect1">Estado del pedido</label>
        <select class="form-control" id="estadoActual">
            <option value="1" >Abierto</option>
            <option value="2" >Pendiente</option>
            <option value="3" >Terminado</option>
            <option value="4" >Cerrado</option>
            <option value="5" >Entregado</option>
        </select>
    </div>
  </div>

  <div class="col">
    <div class="mt-4">
        <button type="button" class="btn btn-outline-danger" onCLick="modificarEstadoMasivo()">Modificar Estado</button>
    </div>
    </div>
</div>
    <!-- ESCRIBIR A PARTIR DE ACA -->
    <table class="table table-hover" id="pendientes">
        <thead>
            <tr>
                <th scope="col">LOCAL</th>
                <th scope="col">FECHA</th>
                <th scope="col">NRO PEDIDO</th>
                <th scope="col">CANT TOTAL</th>
                <th scope="col">CANT ENTREGADA</th>
                <th scope="col">FECHA ENTREGA</th>
                <th scope="col">ESTADO</th>
                <th scope="col">SELEC</th>
                <th scope="col">ARMAR</th>
                <th scope="col">TACHOS</th>

            </tr>
        </thead>
        <tbody>

            <?php 
            foreach ($listado as $key => $value) {
            ?>    
                <tr>
                    <td><?=$value->NOMBRE_LOCAL;?></td>
                    <td><?=$value->FECHA_PED;?></td>
                    <td><a href="pendientesDetalle.php?nroPedido=<?=$value->NRO_PEDIDO;?>"><?=$value->NRO_PEDIDO;?></td>
                    <td><?=$value->CANT_PED;?></td>
                    <td><?=$value->CANT_ENT;?></td>
                    <td><?=$value->FECHA_ENTREGA;?></td>
                    <td><?=$value->DESC_ESTADO;?></td>
                    <td><input type="checkbox" name="pedido[<?=$value->NRO_PEDIDO;?>]" id="pedidoActua" value="<?=$value->NRO_PEDIDO;?>"> </td>
                    <td><a href="armarPedido.php?nroPedido=<?=$value->NRO_PEDIDO;?>"><i class="fas fa-shopping-cart fa-1x"></i></a></td>
                    <td><a href="armarPedidoTachos.php?nroPedido=<?=$value->NRO_PEDIDO;?>"><i class="fas fa-barcode fa-2x"></i></a></td>
                </tr>
            <?php    
            }
            ?>

        </tbody>
    </table>

</div>

<?php include __DIR__."/../Vista/footer.php";   ?>
<script>
$(document).ready(function() {
	  $('#pendientes').DataTable({
	    "language": {
	      "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
	    },
        select: true,
        dom: 'lBfrtip', 
        buttons: [   'copy', 'excel', 'pdf', 'print' ],
        "pageLength": 50,
        fixedHeader: true
	  });
	});
</script>
<script src="Controlador/main.js"></script>
<?php } ?>