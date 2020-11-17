<?php 

session_start(); 
if(!isset($_SESSION['username'])){
	header("Location:login.php");
}else{

    $user = $_SESSION['username'];

    include __DIR__."/../Class/pedidos.php";

    $pendientesGustos = new Pedido();
    $listado = $pendientesGustos->pendientesGustos();

?> 
<?php include __DIR__."/../Vista/head_0.php";   ?>
<title>Perlatto - Pendientes</title>
<?php include __DIR__."/../Vista/head.php";   ?>

<div class="container mt-2 mb-2">
    <!-- ESCRIBIR A PARTIR DE ACA -->
    <table class="table table-hover" id="detalleGustos">
        <thead>
            <tr>
                <th scope="col">CODIGO</th>
                <th scope="col">DESC GUSTO</th>
                <th scope="col">PEDIDO</th>
                <th scope="col">ENTREGADO</th>
                <th scope="col">PENDIENTE</th>
                
            </tr>
        </thead>
        <tbody>

            <?php 
            foreach ($listado as $key => $value) {
            ?>    
                <tr>
                    <td><?=$value->COD_GUSTO;?></td>
                    <td><?=$value->DESC_GUSTO;?></td>
                    <td><?=$value->CANT_PED;?></td>
                    <td><?=$value->CANT_ENT;?></td>
                    <td><?=$value->CANT_PENDI;?></td>
                    
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
	  $('#detalleGustos').DataTable({
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