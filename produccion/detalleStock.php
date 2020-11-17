<?php 
session_start(); 
if(!isset($_SESSION['username'])){
	header("Location:login.php");
}else{
?>

<?php include __DIR__."/../Vista/head_0.php";   ?>
<title>Stock</title>
<?php include __DIR__."/../Vista/head.php";   ?>
<?php include __DIR__."/../Class/produccion.php";  
$codGusto = $_GET['codGusto'];
$produccion = new Produccion();
$list = $produccion->stockGusto($codGusto);
?>

    <div class="container">
    
    
    <div class="row">
        <div class="col"></div>
        <div class="col text-center"><h3>Detalle del Stock Actual</h3></div>
        <div class="col"></div>
        </div>
        <table id="tabla_locales" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th style="width: 10%">Fecha</th>
                        <th style="width: 10%">Partida</th>
                        <th style="width: 10%">Operario</th>
                        <th style="width: 10%">Cod Grupo</th>
                        <th style="width: 15%">Cod Gusto</th>
                        <th style="width: 15%">Descripcion</th>
                        <th style="width: 10%">Kilos</th>            
                    </tr>
                </thead>
                <tbody>
                
                <?php
                $total = 0;
                foreach ($list as $key => $value) {
                ?>
                
                <tr>      
                    <td><?=$value->FECHA?></td>
                    <td><?=$value->PARTIDA?></td>
                    <td><?=$value->OPERARIO?></td>
                    <td><?=$value->GRUPO?></a></td>
                    <td><?=$value->COD_GUSTO?></td>
                    <td><?=$value->DESC_GUSTO?></td>
                    <td><?php echo number_format($value->PESO, 4, ',', ' '); $total = $total + $value->PESO; ?></td>

                </tr>

                <?php
                }

                ?>

                <tr>      
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>TOTAL</td>
                    <td><?php echo number_format($total, 4, ',', ' '); ?></td>

                </tr>



                </tbody>

            </table>

        <script>
        $(document).ready(function() {
            $('#tabla_locales').DataTable({
                "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
                }
            });
            });

            $('#myModal').on('shown.bs.modal', function () {
                $('#myInput').trigger('focus')
            })

        </script>

    </div>

<?php include __DIR__."/../Vista/footer.php";   ?>

<?php } ?>