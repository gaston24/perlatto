<?php 
session_start(); 
if(!isset($_SESSION['username']) || $_SESSION['tipo'] != "ADMIN"){
	header("Location:login.php");
}else{
?>

    <?php include __DIR__."/../Vista/head_0.php";   ?>
    <title>Lista de Valores</title>
    <?php include __DIR__."/../Vista/head.php";   ?>
    <?php 
    include __DIR__."/../Class/maestro.php";   

    $maestro = new Maestro();

    $todosLosValores = $maestro->traerTodos();

    ?>

    <div class="container">
        
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <div class="row">
            <div class="col"></div>
            <div class="col"><h3>Lista de Valores</h3></div>
            <div class="col"><a href="agregarValores.php?"><button>Agregar</button></a></div>
        </div>

        <table id="tabla_valores" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th hidden>id</th>
                        <th>Descripcion</th>
                        <th>Costo</th>
                        <th>Modificar</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($todosLosValores as $value) {
                    ?>

                        <tr>
                            <td hidden><?= $value['id'] ?></td>
                            <td ><?= $value['descripcion'] ?></td>
                            <td style="text-align:right">$<?php echo number_format($value['valor'], 2, ',', '.'); ?></td>
                            <td  style="width:30px;text-align:center" ><a href="editarValores.php?id=<?= $value['id'] ?>"><i class="fas fa-edit"></i></a></td>
                            <td style="width:30px"><button class="btn btn-danger" style="width:10px:height:10px" onclick="eliminar(this)">X</button></td>
                        </tr>
                    <?php                        
                        }
                    ?>
                </tbody>
        </table>

        <script>
            $(document).ready(function() {
                $('#tabla_valores').DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
                },
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
    <script src="js/valores.js"></script>

<?php } ?>