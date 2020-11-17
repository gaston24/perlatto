<?php 

session_start(); 
if(!isset($_SESSION['username'])){
	header("Location:login.php");
}else{

    $user = $_SESSION['username'];
    $suc = $_SESSION['nroSuc'];

    include __DIR__."/../Class/pedidos.php";

    $nroPedido = $_GET['ped'];

    $historial = new Pedido();
    $listado = $historial->traerDetalleFiltrado($suc, $nroPedido);

?> 

<?php include __DIR__."/../Vista/head_0.php";   ?>
<title>Detalle Pedido</title>
<?php include __DIR__."/../Vista/head.php";   ?>

<div class="container">
    <!-- ESCRIBIR A PARTIR DE ACA -->
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">CODIGO</th>
                <th scope="col">DESCRIPCION</th>
                <th scope="col">CANT PEDIDO</th>
                <th scope="col">CANT ENTREGADA</th>
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
            </tr>        
        <?php
            }
        ?>

        </tbody>
    </table>

</div>

<?php include __DIR__."/../Vista/footer.php";   ?>

<?php } ?>