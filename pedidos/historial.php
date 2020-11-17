<?php 

session_start(); 
if(!isset($_SESSION['username'])){
	header("Location:login.php");
}else{

    $user = $_SESSION['username'];
    $suc = $_SESSION['nroSuc'];

    include __DIR__."/../Class/pedidos.php";

    $historial = new Pedido();
    $listado = $historial->historial($suc);

?> 

<?php include __DIR__."/../Vista/head_0.php";   ?>
<title>Perlatto - Historial</title>
<?php include __DIR__."/../Vista/head.php";   ?>

<div class="container">
    <!-- ESCRIBIR A PARTIR DE ACA -->
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">FECHA</th>
                <th scope="col">NRO PEDIDO</th>
                <th scope="col">CANT TOTAL</th>
                <th scope="col">FECHA ENTREGA</th>
            </tr>
        </thead>
        <tbody>

            <?php 
            foreach ($listado as $key => $value) {
            ?>    
                <tr>
                    <td><?=$value->FECHA_PED;?></td>
                    <td><a href="historial_detalle.php?ped=<?=$value->NRO_PEDIDO;?>"><?=$value->NRO_PEDIDO;?></a></td>
                    <td><?=$value->CANT;?></td>
                    <td><?=$value->FECHA_PED;?></td>
                </tr>
            <?php    
            }
            ?>

        </tbody>
    </table>

</div>

<?php include __DIR__."/../Vista/footer.php";   ?>
<?php } ?>