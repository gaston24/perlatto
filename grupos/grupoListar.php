<?php 
session_start(); 
if(!isset($_SESSION['username'])){
	header("Location:login.php");
}else{
?>

<?php include __DIR__."/../Vista/head_0.php";   ?>
<title>Ver Grupos</title>
<?php include __DIR__."/../Vista/head.php";   ?>
<?php include __DIR__."/../Class/grupos.php";   

$grupo = new Grupo();
$list = $grupo->traerTodos();
?>

    <div class="container">
    
    
    <div class="row">
        <div class="col"></div>
        <div class="col"><h3>Listado de Grupos</h3></div>
        <div class="col"></div>
        </div>
        <table id="tabla_locales" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th style="width: 10%">Cod Grupo</th>
                        <th style="width: 15%">Descripcion Grupo</th>
                        <th style="width: 10%">Eliminar</th>                        
                    </tr>
                </thead>
                <tbody>
                
                <?php

                foreach ($list as $key => $value) {
                ?>
                
                <tr>      
                    <td><?=$value->COD_GRUPO?></td>
                    <td><?=$value->DESC_GRUPO?></td>
                    <td><a href="#" onClick="eliminarGrupo('<?=$value->COD_GRUPO?>')"><i class="fas fa-trash"></i></a></td>

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

<script src="Controlador/mainGrupos.js"></script>
<?php include __DIR__."/../Vista/footer.php";   ?>


<?php } ?>