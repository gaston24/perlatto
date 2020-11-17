<?php 
session_start(); 
if(!isset($_SESSION['username'])){
	header("Location:login.php");
}else{
?>
<?php include __DIR__."/../Vista/head_0.php";   ?>
<title>Ver Usuarios</title>
<?php include __DIR__."/../Vista/head.php";   ?>
<?php include __DIR__."/../Class/usuarios.php"; 
$usuarios = new Usuarios();
$list = $usuarios->traerUsuariosLocales();
?>

    <div class="container">
    
    
    <div class="row">
        <div class="col"></div>
        <div class="col"><h3>Listado de Usuarios</h3></div>
        <div class="col"></div>
        </div>
        <table id="tabla_locales" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th style="width: 10%">Nro Local</th>
                        <th style="width: 15%">Local</th>
                        <th style="width: 15%">Contacto</th>
                        <th style="width: 15%">Telefono</th>
                        <th style="width: 20%">Email</th>
                        <th style="width: 10%">Estado</th>                        
                        <th style="width: 10%">Modificar</th>            
                    </tr>
                </thead>
                <tbody>
                
                <?php

                foreach ($list as $key => $value) {
                ?>
                
                <tr>      
                    <td><?=$value->NRO_LOCAL?></td>
                    <td><?=$value->DESCRIPCION?></td>
                    <td><?=$value->CONTACTO?></td>
                    <td><?=$value->TELEFONO?></td>
                    <td><?=$value->EMAIL?></td>
                    <td><?=$value->ESTADO?></td>
                    <td><a href="usuarioModificar.php?nro=<?=$value->NRO_LOCAL?>"><i class="fas fa-user-edit"></i></a></td>

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