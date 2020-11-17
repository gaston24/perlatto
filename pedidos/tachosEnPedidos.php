<?php 

session_start(); 
if(!isset($_SESSION['username'])){
	header("Location:login.php");
}else{

    include __DIR__."/../Class/pedidos.php";

    $pendientes = new Pedido();
    $nroPedido = $_GET['nroPedido'];
    $listado = $pendientes->tachosEnPedido($nroPedido);


?> 
<?php include __DIR__."/../Vista/head_0.php";   ?>
<title>Perlatto - Pendientes</title>
<?php include __DIR__."/../Vista/head.php";   ?>

<div class="container">
    <!-- ESCRIBIR A PARTIR DE ACA -->


    <table class="table table-hover" id="pendientes">
        <thead>
            <tr>
                <th scope="col">FECHA</th>
                <th scope="col">COD GUSTO</th>
                <th scope="col">DESC GUSTO</th>
                <th scope="col">PARTIDA</th>
                <th scope="col">NUM TACHO</th>
                <th scope="col">PESO</th>
            </tr>
        </thead>
        <tbody>

            <?php 
            foreach ($listado as $key => $value) {
            ?>    
                <tr>
                    <td><?=$value->FECHA;?></td>
                    <td><?=$value->COD_GUSTO;?></td>
                    <td><?=$value->DESC_GUSTO;?></td>
                    <td><?=$value->PARTIDA;?></td>
                    <td><?=$value->NUM_TACHO;?></td>
                    <td><?=$value->PESO;?></td>
                    

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