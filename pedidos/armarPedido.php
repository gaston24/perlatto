<?php 

session_start(); 
if(!isset($_SESSION['username'])){
	header("Location:login.php");
}else{

    $user = $_SESSION['username'];
    $suc = $_SESSION['nroSuc'];

    include __DIR__."/../Class/pedidos.php";

    $pendientes = new Pedido();
    $nroPedido = $_GET['nroPedido'];
    $listado = $pendientes->pendientesTraerUno($nroPedido);
    $estado = $pendientes->buscarEstado($nroPedido);

?> 
<?php include __DIR__."/../Vista/head_0.php";   ?>
<title>Perlatto - Pendientes</title>
<?php include __DIR__."/../Vista/head.php";   ?>

<div class="container">
    <!-- ESCRIBIR A PARTIR DE ACA -->

  <div class="row">
  <div class="col"></div>
  
  <div class="col">
    <div class="form-group">
        <label for="exampleFormControlSelect1">Estado del pedido</label>
        <select class="form-control" id="estadoActual">
            <option value="1" <?php if($estado==1){echo 'selected';} ?> >Abierto</option>
            <option value="2" <?php if($estado==2){echo 'selected';} ?> >Pendiente</option>
            <option value="3" <?php if($estado==3){echo 'selected';} ?> >Terminado</option>
            <option value="4" <?php if($estado==4){echo 'selected';} ?> >Cerrado</option>
            <option value="5" <?php if($estado==5){echo 'selected';} ?> >Entregado</option>
        </select>
    </div>
  </div>

  <div class="col">
    <div class="mt-4">
        <button type="button" class="btn btn-outline-danger" onCLick="modificarPedido(<?=$nroPedido?>)">Modificar Estado</button>
    </div>
  </div>
  
  
  </div>  

    <table class="table table-hover" id="pendientes">
        <thead>
            <tr>
                <th scope="col">LOCAL</th>
                <th scope="col">FECHA</th>
                <th scope="col">NRO PEDIDO</th>
                <th scope="col">COD GUSTO</th>
                <th scope="col">GUSTO</th>
                <th scope="col">CANT TOTAL</th>
                <th scope="col">CANT ENTREGADA</th>
                <th scope="col">FECHA ENTREGA</th>

            </tr>
        </thead>
        <tbody>

            <?php 
            foreach ($listado as $key => $value) {
            ?>    
                <tr>
                    <td><?=$value->NOMBRE_LOCAL;?></td>
                    <td><?=$value->FECHA_PED;?></td>
                    <td><?=$value->NRO_PEDIDO;?></td>
                    <td><?=$value->COD_GUSTO;?></td>
                    <td><?=$value->DESC_GUSTO;?></td>
                    <td><?=$value->CANT_PED;?></td>
                    <td><input type="text" size="1" class="form-control form-control-sm" value="<?=$value->CANT_ENT;?>"></td>
                    <td><?=$value->FECHA_ENTREGA;?></td>

                </tr>
            <?php    
            }
            ?>

        </tbody>
    </table>

</div>

<?php include __DIR__."/../Vista/footer.php";   ?>

<script src="Controlador/main.js"></script>
<?php } ?>