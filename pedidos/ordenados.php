<?php 

session_start(); 
if(!isset($_SESSION['username'])){
	header("Location:login.php");
}else{

    $user = $_SESSION['username'];
    $suc = $_SESSION['nroSuc'];

    include __DIR__."/../Class/pedidos.php";

    $pendientes = new Pedido();
    $listado = $pendientes->pendientesOrdenados();

?> 
<?php include __DIR__."/../Vista/head_0.php";   ?>
<title>Perlatto - Pendientes</title>
<?php include __DIR__."/../Vista/head.php";   ?>

<div class="container-fluid mt-2 mb-2">
    <!-- ESCRIBIR A PARTIR DE ACA -->
    <table class="table table-hover" id="todosPedidos">
        <thead>
            <tr>
                <th scope="col">COD GUSTO</th>
                <th scope="col">DESC GUSTO</th>
                <th scope="col">Villa Adelina</th>
                <th scope="col">Munro</th>
                <th scope="col">Olivos</th>
                <th scope="col">Caseros</th>
                <th scope="col">Villa Ballester</th>
                <th scope="col">San Andres</th>
                <th scope="col">San Martin</th>
                <th scope="col">San Fernando</th>
                <th scope="col">Santos Lugares</th>
                <th scope="col">Martinez</th>
                <th scope="col">San isidro</th>
                <th scope="col">Garin</th>
                <th scope="col">Escobar</th>
                <th scope="col">Villa Bosch</th>
                <th scope="col">Tigre</th>
                <th scope="col">San Miguel</th>
                <th scope="col">Ramos Mejia</th>
                <th scope="col">Moron</th>
            </tr>
        </thead>
        <tbody>

            <?php 
            foreach ($listado as $key => $value) {
            ?>    
                <tr>
                    <td><?=$value->COD_GUSTO;?></td>
                    <td><?=$value->DESC_GUSTO;?></td>
                    <td><?=$value->Villa_adelina;?></td>
                    <td><?=$value->Munro;?></td>
                    <td><?=$value->Olivos;?></td>
                    <td><?=$value->Caseros;?></td>
                    <td><?=$value->Villa_ballester;?></td>
                    <td><?=$value->San_andres;?></td>
                    <td><?=$value->San_martin;?></td>
                    <td><?=$value->San_fernando;?></td>
                    <td><?=$value->Santos_Lugares;?></td>
                    <td><?=$value->Martinez;?></td>
                    <td><?=$value->San_Isidro;?></td>
                    <td><?=$value->Garin;?></td>
                    <td><?=$value->Escobar;?></td>
                    <td><?=$value->Villa_Bosch;?></td>
                    <td><?=$value->Tigre;?></td>
                    <td><?=$value->San_Miguel;?></td>
                    <td><?=$value->Ramos_Mejia;?></td>
                    <td><?=$value->Moron;?></td>

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