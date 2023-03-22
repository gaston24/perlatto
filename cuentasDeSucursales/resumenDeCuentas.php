<?php 

session_start(); 
if(!isset($_SESSION['username'])){
	header("Location:login.php");
}else{

    $user = $_SESSION['username'];
    $suc = $_SESSION['nroSuc'];

    include __DIR__."/../Class/locales.php";   

    $local = new Local();

    $todosLosLocales = $local->traerLocales();
    include __DIR__."/../Class/cuenta.php";
    $cuentas = new Cuenta();
    
   
?> 
<?php include __DIR__."/../Vista/head_0.php";   ?>
    <title>Perlatto - Pendientes</title>
<?php include __DIR__."/../Vista/head.php";   ?>

<div class="container mt-2 mb-2" style="background-color:white">

    <div class="row">
        <div class="col" style="margin-bottom: 5rem;"  id="a"></div>
    </div>
    <!-- ESCRIBIR A PARTIR DE ACA -->
    <table class="table table-hover" id="pendientes">
        <thead>
            <tr>
            <th scope="col">NUMERO DE SUCURSAL</th>
            <th scope="col">LOCAL</th>
            <th scope="col">TOTAL DE CUENTA</th>
            <th scope="col">FECHA ULTIMO MOVIMIENTO</th>
            </tr>
        </thead>
        <tbody>

            <?php 
                foreach ($todosLosLocales as $key => $value) {
                $total = 0;

            ?>    
            <tr>
                <td style="text-align:left"><?=$value['ID_LOCAL'];?></td>
                <td><a href="listar.php?idSucursal=<?= $value['ID_LOCAL'] ?>&nombreSucursal=<?=$value['LOCAL'] ?>"><?=$value['LOCAL'];?></a></td>

                <?php 
                    $listado = $cuentas->getAll($value['ID_LOCAL']);

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

                <td id="importe" style="text-align:right"><?= $total;?></td>
                <td style="text-align:right"><?=$ultimoMovimiento?></td>
            </tr>
            <?php    
            }
            ?>

        </tbody>

    </table>

</div>

<?php include __DIR__."/../Vista/footer.php";   ?>
<script>
    const parseNumber = (value)=>{
        return value.toLocaleString('en-US', {
            style: 'decimal',
        });
    }

    $(document).ready(function() {

        $('#pendientes').DataTable({
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


        let importes = document.querySelectorAll("#importe");

        let total = 0

        importes.forEach(element => {
            movimiento = element.parentElement.childNodes[3].textContent;
            if(movimiento == "entrada"){
                total += parseFloat(element.textContent);
            }else if( movimiento == "salida"){
                total -= parseFloat(element.textContent);
            }        

            let importeRealizado =  parseFloat(element.textContent).toFixed(2)
            importeRealizado=parseNumber(importeRealizado);
            element.textContent = importeRealizado
        });





        total = parseNumber(total);
        document.querySelector("#total").textContent = total 

    });

</script>
<link rel="stylesheet" href="css/style.css">

<?php } ?>