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

<div class="container mt-2 mb-2">
    <!-- ESCRIBIR A PARTIR DE ACA -->
    <table class="table table-hover" id="todosPedidos">
        <thead>
            <tr>
                <th scope="col">COD GUSTO</th>
                <th scope="col">DESC GUSTO</th>
                <th scope="col">VILLA ADELINA</th>
                <th scope="col">MUNRO</th>
                <th scope="col">OLIVOS</th>
                <th scope="col">CASEROS</th>
                <th scope="col">VILLA BALLESTER</th>
                <th scope="col">SAN ANDRES</th>
                <th scope="col">SAN MARTIN</th>
                <th scope="col">SAN FERNANDO</th>
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