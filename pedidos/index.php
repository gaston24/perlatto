<?php 
session_start(); 
if(!isset($_SESSION['username'])){
	header("Location:login.php");
}else{
?>

<?php include __DIR__."/../Vista/head_0.php";   ?>
<title>Pedido Nuevo</title>
<?php include __DIR__."/../Vista/head.php";   ?>
<?php 
include __DIR__."/../Class/gustos.php";

$gustos = new Gusto();
$listado = $gustos->traerActivos();
?>

    <div class="container">

    <div style="width:100%; padding-bottom:5%; margin-bottom:5%" >
  
		  <table class="table table-striped table-condensed table-fh table-4c" id="id_tabla">
			
		<thead>
			<tr style="font-size:smaller">
                <th style="width: 0%"></th>
				<th style="width: 25%"> <div class="row"> <div class="col-4 mt-2">GRUPO</div> <div class="col-8"><input type="text" class="form-control form-control-sm" onkeyup="busquedaRapida()" id="textBox" size="2" placeholder="Filtro Rapido" autofocus></div>   </div>  </th>
				<th style="width: 25%">DESCRIPCION</th>
				<th style="width: 25%"> <div class="row"> <div class="col-4 mt-2">CANTIDAD</div> <div class="col-8"><input type="text" class="form-control form-control-sm" id="cantBox" size="2" value="0" disabled></div>   </div>  </th>
                <th style="width: 25%"><button class="btn btn-primary btn-sm" onClick="enviarPedido()">Enviar</button></th>
            </tr>
        </thead> 
        <tbody id="tabla">
            
            <?php foreach ($listado as $key => $value) { ?>

                <tr>
                    <td><input type="hidden" name="codigo[]" value="<?= $value->COD_GUSTO; ?>"></td>
                    <td><?= $value->GRUPO; ?></td>
                    <td><?= $value->DESC_GUSTO; ?></td>
                    <td><input type="number" class="form-control" id="cantidadGusto" name="cantidad[]" value="0" onkeyup="changeCantidad()"></td>
                    <td></td>
                </tr>

            <?php } ?>
            
        </tbody>       


    </div>


<?php include __DIR__."/../Vista/footer.php";   ?>

<?php } 
$suc = $_SESSION['nroSuc'];
?>

<script>
    var suc = '<?=$suc;?>'
    // console.log(suc);
</script>
<script src="Controlador/main.js"></script>
