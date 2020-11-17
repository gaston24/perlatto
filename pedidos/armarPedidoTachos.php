<?php 
session_start(); 
if(!isset($_SESSION['username'])){
	header("Location:login.php");
}else{
    include __DIR__."/../Class/pedidos.php";
?>

<?php include __DIR__."/../Vista/head_0.php";   ?>
<title>Agregar Tachos</title>
<?php include __DIR__."/../Vista/head.php";   ?>

    <div class="container mt-3">

        <div>
        
            <form action="Controlador/cargarTacho.php" method="post">  
                <div class="row">
                
                    <div class="col">
                    </div>
                    <div class="col form-group">
                        <label for="partida">Codigo del tacho:</label>
                        <input type="text" class="form-control" id="gusto" name="tacho" autofocus>
                        <input type="hidden" name="nroPedido" value="<?= $_GET['nroPedido'];?>">
                    </div>
                    <div class="col">
                    </div>

                </div>
                <div class="row">
                
                    <div class="col">
                    </div>
                    <div class="col form-group">
                        <input type="submit" class="btn btn-primary" value="Agregar">
                    </div>
                    <div class="col">
                    </div>

                </div>
                
                
            </form>

        </div>

        <?php if(isset($_GET['success'])){ 
            $nroPedido = $_GET['nroPedido'];
            $pedido = new Pedido();
            $list = $pedido->traerPedidoArmando($nroPedido);    
        ?>

        <div class="row mb-5">
            <div class="col"></div>
            <div class="col"></div>
            <div class="col"><button class="btn btn-success" onClick="window.location = 'confirmarTachos.php?nroPedido=<?=$_GET['nroPedido']?>'">Procesar</button></div>
        </div>

        <div>

        <table id="tabla_locales" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th style="width: 15%">Cod Gusto</th>
                        <th style="width: 15%">Descripcion</th>
                        <th style="width: 10%">Partida</th>
                        <th style="width: 10%">Num Tacho</th>                        
                        <th style="width: 10%">Peso</th>            
                    </tr>
                </thead>
                <tbody>
                
                <?php

                foreach ($list as $key => $value) {
                ?>
                
                <tr>      
                    <td><?=$value->COD_GUSTO?></td>
                    <td><?=$value->DESC_GUSTO?></td>
                    <td><?=$value->PARTIDA?></td>
                    <td><?=$value->NUM_TACHO?></td>
                    <td><?=$value->PESO?></td>

                </tr>

                <?php
                }

                ?>



                </tbody>

            </table>
        
        </div>

        




        <?php } ?>

    </div>


<?php include __DIR__."/../Vista/footer.php";   ?>
<?php } ?>