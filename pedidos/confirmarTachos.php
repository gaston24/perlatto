<?php 
session_start(); 
if(!isset($_SESSION['username'])){
	header("Location:login.php");
}else{
    include __DIR__."/../Class/pedidos.php";

    $nroPedido = $_GET['nroPedido'];
    $pedido = new Pedido();
    $list = $pedido->preConfirmarTachos($nroPedido);  
?>

<?php include __DIR__."/../Vista/head_0.php";   ?>
<title>Agregar Tachos</title>
<?php include __DIR__."/../Vista/head.php";   ?>

    <div class="container mt-3">

        <div class="row mb-3">
            <div class="col"></div>
            <div class="col text-center"><h3>Confirmar pedido N°: <?=$nroPedido?></h3></div>
            <div class="col"><button type="button" class="btn btn-outline-success btn-lg btn-block" onClick="insertarTachosPedido(<?=$nroPedido?>)">CONFIRMAR Y PROCESAR PEDIDO</button></div>
        </div>

        <div>

        <table id="tabla_locales" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th style="width: 15%">Cod Gusto</th>
                        <th style="width: 15%">Descripcion</th>
                        <th style="width: 10%">Pedido</th>
                        <th style="width: 10%">Entregado</th>                        
                        <th style="width: 10%">Pendiente</th>            
                        <th style="width: 10%">Controlado</th>            
                    </tr>
                </thead>
                <tbody>
                
                <?php

                foreach ($list as $key => $value) {
                ?>
                
                <tr>      
                    <td><?=$value->COD_GUSTO?></td>
                    <td><?=$value->DESC_GUSTO?></td>
                    <td><?=$value->CANT_PED?></td>
                    <td><?=$value->CANT_ENT?></td>
                    <td><?=$value->CANT_PENDI?></td>
                    <td><?=$value->CANT_TACHOS?></td>
                    

                </tr>

                <?php
                }

                ?>



                </tbody>

            </table>
        
        </div>

    </div>

    <script src="Controlador/main.js"></script>


<?php include __DIR__."/../Vista/footer.php";   ?>
<?php } ?>