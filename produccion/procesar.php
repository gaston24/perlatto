<?php 

session_start(); 
if(!isset($_SESSION['username'])){
	header("Location:login.php");
}else{

    include __DIR__."/../Class/produccion.php";

    $produccion = new produccion();
    $listado = $produccion->pendientesAux();

?> 
<?php include __DIR__."/../Vista/head_0.php";   ?>
<title>Perlatto - Pendientes de Ingreso</title>
<?php include __DIR__."/../Vista/head.php";   ?>

<div class="container mt-2 mb-2">

    <div>

        <!-- ESCRIBIR A PARTIR DE ACA -->
        <table class="table table-hover" id="pendientes">
            <thead>
                <tr>
                    <th scope="col">FECHA</th>
                    <th scope="col">GUSTO</th>
                    <th scope="col">PESO</th>
                    <th scope="col">PARTIDA</th>
                    <th scope="col">NUM PARTIDA</th>
                    <th scope="col">OPERARIO</th>
                    <th scope="col">NUM TACHO</th>

                </tr>
            </thead>
            <tbody>

                <?php 
                foreach ($listado as $key => $value) {
                    ?>    
                    <tr>
                        <td><?=$value->FECHA;?></td>
                        <td><?=$value->COD_GUSTO;?></td>
                        <td><?=$value->PESO;?></td>
                        <td><?=$value->PARTIDA;?></td>
                        <td><?=$value->NUM_PARTIDA;?></td>
                        <td><?=$value->OPERARIO;?></td>
                        <td><?=$value->NUM_TACHO;?></td>
                    </tr>
                <?php    
                }
                ?>

            </tbody>
        </table>

    </div>

    <div class="row mt-5">
    <div class="col"></div>
    <div class="col"><button class="btn btn-danger" onClick="location.href='nuevos.php'"> Cancelar lote y volver</button></div>
    <div class="col"><button class="btn btn-success" onClick="procesar()"> Confirmar e ingresar al stock</button></div>
    <div class="col"></div>
    </div>


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