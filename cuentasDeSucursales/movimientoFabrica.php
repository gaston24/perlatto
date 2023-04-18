<?php 
session_start(); 
if(!isset($_SESSION['username']) || $_SESSION['username'] != "ADMINISTRADOR"){
	header("Location:login.php");
}else{
?>

<?php include __DIR__."/../Vista/head_0.php";   ?>
<title>Ver Gustos</title>
<?php include __DIR__."/../Vista/head.php";   ?>
<?php 
include __DIR__."/../Class/cuenta.php";
include __DIR__."/../Class/locales.php";   

$local = new Local();

$cuentas = new Cuenta();


$todosLosLocales = $local->traerLocales();

?>

<div class="container">
    
    
    <div class="row">
        <div class="col"></div>
        <div class="col"><h3>Movimiento De Fabrica</h3></div>
        <div class="col"><a href="nuevaEntrada.php?tipoMovimiento=0"><button>Agregar Movimiento</button></a></div>
    </div>

    <table id="tabla_locales" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Franquicia</th>
                    <th>Importe</th>
                    <th>Ultimo Movimiento</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($todosLosLocales as $key => $value) { 
                        $total = 0;

                        ?>
                        <tr>
                            <td><a href="listar.php?idSucursal=<?= $value['ID_LOCAL'] ?>&nombreSucursal=<?=$value['LOCAL'] ?>&idTipo=0"><?= $value['LOCAL'] ?></a></td>
                            
                        <?php 
                        $listado = $cuentas->getFabrica($value['ID_LOCAL']);

                        $ultimoMovimiento = 0;

                        foreach ($listado as $e ) {
                            if($e['tipo_movimiento'] == "entrada" ){
                                $total += $e['importe'];
                            }else if ($e['tipo_movimiento'] == "salida" ){
                                $total -= $e['importe'];
                            }
                        $ultimoMovimiento = $e['created_at'];    
                        }
                        ?>
                            <td style="text-align:right"><?= $total ?></td>
                            <td style="text-align:right"><?= $ultimoMovimiento ?></td>
                        </tr>
                <?php
                    }
                ?>


            </tbody>
    </table>

    <script>
        $(document).ready(function() {
            $('#tabla_locales').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
            },
                select: true,
                order: [[1,'asc']],
                dom: 'lBfrtip', 
                buttons: [   'copy', 'excel', 'pdf', 'print' ],
                "pageLength": 50,
                fixedHeader: true
            });
        });

    </script>

</div>

<?php include __DIR__."/../Vista/footer.php";   ?>

<?php } ?>