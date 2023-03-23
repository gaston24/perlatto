<?php 

session_start(); 
if(!isset($_SESSION['username'])){
	header("Location:login.php");
}else{

    $user = $_SESSION['username'];
    $suc = $_SESSION['nroSuc'];

    if(!isset($_GET['desde'])){
        $desde = date("Y-m-d");
        $hasta = date("Y-m-d");
    }else{
        $desde = $_GET['desde'];
        $hasta = $_GET['hasta'];
    }


    include __DIR__."/../Class/pedidos.php";

    $pendientes = new Pedido();
    $listado = $pendientes->pendientesTodos($suc, $desde, $hasta);

?> 
<?php include __DIR__."/../Vista/head_0.php";   ?>
<title>Perlatto - Pendientes</title>
<?php include __DIR__."/../Vista/head.php";   ?>

<div class="container mt-2 mb-2">
    
<form action="#" method="get">
    <div class="form-row">
        <div class="col-md-2 mb-3">
        </div>
        <div class="col-md-1 mb-3">
        <p class="text-right mt-1">Desde:</p>
        </div>
        <div class="col-md-2 mb-3">
            <input type="date" class="form-control" name="desde" value="<?=$desde?>" >
        </div>
        <div class="col-md-1 mb-3">
        <p class="text-right mt-1">Hasta:</p>
        </div>
        <div class="col-md-2 mb-3">
            <input type="date" class="form-control" name="hasta" value="<?=$hasta?>" >
        </div>
        <div class="col-md-2 mb-3">
            <input type="submit" class="btn btn-primary " value="Consultar">
        </div>
        <div class="col-md-2 mb-3">
        </div>
    </div>
</form>

    <table class="table table-hover" id="todosPedidos">
        <thead>
            <tr>
                <th scope="col">LOCAL</th>
                <th scope="col">FECHA</th>
                <th scope="col">NRO PEDIDO</th>
                <th scope="col">CANT TOTAL</th>
                <th scope="col">CANT ENTREGADA</th>
                <th scope="col">FECHA ENTREGA</th>
                <th scope="col">ESTADO</th>
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
                    <td><a href="tachosEnPedidos.php?nroPedido=<?=$value->NRO_PEDIDO;?>"> <i class="fas fa-trash"></i> </a></td>
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
	  $('#todosPedidos').DataTable({
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

<?php } ?>