<?php 

session_start(); 

if(!isset($_SESSION['username']) || $_SESSION['tipo'] != "ADMIN"){
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
    <title>Perlatto - Movimiento Franquicia</title>
<?php include __DIR__."/../Vista/head.php";   ?>

<div class="container mt-2 mb-2" style="background-color:white">

    <div class="row">
        <div class="col" style="margin-bottom: 5rem;"  id="a"></div>
    </div>
    <div class="row">
        <div class="col"></div>
        <div class="col"><h3>Movimiento De Franquicia</h3></div>
        <div class="col"><a href="nuevaEntrada.php?tipoMovimiento=1"><button>Agregar Movimiento</button></a></div>
    </div>
    <!-- ESCRIBIR A PARTIR DE ACA -->
    <table class="table table-striped table-bordered" id="pendientes">
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
                <td><a href="listar.php?idSucursal=<?= $value['ID_LOCAL'] ?>&nombreSucursal=<?=$value['LOCAL'] ?>&idTipo=1"><?=$value['LOCAL'];?></a></td>

                <?php 
                    $listado = $cuentas->getFranquicia($value['ID_LOCAL']);

                    $ultimoMovimiento = 0;

                    foreach ($listado as $e ) {
                        
                        $newArray = explode("_",$e['tipo_movimiento']);
                        
                        if($newArray[0] == "entrada" ){
                        $total += ((int)$e['cantidad'] * (float)$e['valor']);
                        }else if ($newArray[0] == "salida" ){
                        $total -= ((int)$e['cantidad'] * (float)$e['valor']);;
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