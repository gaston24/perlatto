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
$produccion = new Produccion();
$list = $produccion->stockActual();
?>

    <div class="container">
    
    
    <div class="row">
        <div class="col"></div>
        <div class="col text-center"><h3>Stock</h3></div>
        <div class="col"></div>
        </div>
        <table id="tabla_locales" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th style="width: 10%">Cod Grupo</th>
                        <th style="width: 15%">Cod Gusto</th>
                        <th style="width: 15%">Descripcion</th>
                        <th style="width: 10%">Tachos</th>                        
                        <th style="width: 10%">Kilos</th>            
                    </tr>
                </thead>
                <tbody>
                
                <?php

                foreach ($list as $key => $value) {
                ?>
                
                <tr>      
                    <td><?=$value->GRUPO?></td>
                    <td><a href="detalleStock.php?codGusto=<?=$value->COD_GUSTO?>"><?=$value->COD_GUSTO?></a></td>
                    <td><?=$value->DESC_GUSTO?></td>
                    <td><?=$value->TACHOS?></td>
                    <td><?=number_format($value->PESO, 4, ',', ' ') ?></td>

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