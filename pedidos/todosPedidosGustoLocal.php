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
    $listado = $pendientes->pedidosGustoPorLocal($desde, $hasta);

?> 
<?php include __DIR__."/../Vista/head_0.php";   ?>
<title>Perlatto - Pedidos por gusto por local</title>
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
    <!-- ESCRIBIR A PARTIR DE ACA -->
    <table class="table table-hover" id="todosPedidos">
        <thead>
            <tr>
                <th scope="col">LOCAL</th>
                <th scope="col">COD GUSTO</th>
                <th scope="col">DESC GUSTO</th>
                <th scope="col">CANT PEDIDA</th>
            </tr>
        </thead>
        <tbody>

            <?php 
            foreach ($listado as $key => $value) {
            ?>    
                <tr>
                    <td><?=$value->LOCAL;?></td>
                    <td><?=$value->COD_GUSTO;?></td>
                    <td><?=$value->DESC_GUSTO;?></td>
                    <td><?=$value->CANT_PEDIDA;?></td>
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