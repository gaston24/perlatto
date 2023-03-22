<?php 

session_start(); 
if(!isset($_SESSION['username'])){
	header("Location:login.php");
}else{

  $user = $_SESSION['username'];
  $suc = $_SESSION['nroSuc'];

  include __DIR__."/../Class/cuenta.php";
  $cuentas = new Cuenta();
  $listado = $cuentas->getAll($_GET['idSucursal']);

?> 
<?php include __DIR__."/../Vista/head_0.php";   ?>
  <title>Perlatto - Pendientes</title>
<?php include __DIR__."/../Vista/head.php";   ?>

<div class="container mt-2 mb-2" style="background-color:white">

  <div class="row">
    <div class="col" style="margin-bottom: 5rem;"  id="a"><h2>Resumen  de  cuenta  sucursal : <?= $_GET['nombreSucursal']?> (<?= $_GET['idSucursal'] ?>)</h2></div>
  </div>
  <!-- ESCRIBIR A PARTIR DE ACA -->
  <table class="table table-hover" id="pendientes">
    <thead>
      <tr>
      <th scope="col">FECHA</th>
      <th scope="col">TIPO DE MOVIMIENTO</th>
      <th scope="col">IMPORTE</th>
      <th scope="col">OBSERVACIONES</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        foreach ($listado as $key => $value) {
      ?>    

      <tr>
        <td><?=$value['created_at'];?></td>
        <td style="text-align:left"><?=$value['tipo_movimiento'];?></td>
        <td id="importe" style="text-align:right"><?=$value['importe'];?></td>
        <td style="text-align:left"><?=$value['observaciones'];?></td>
      </tr>
      <?php    
        }
      ?>
      </tbody>
      <tfoot>
        <tr>
          <td>TOTAL</td>
          <td></td>
          <td id= "total" style="text-align:right"></td>
          <td></td>
        </tr>
    </tfoot>
  </table>

</div>

<?php include __DIR__."/../Vista/footer.php";   ?>
<script>
  const parseNumber = (value)=>{
    return value.toLocaleString('de-DE', {
      style: 'decimal',
    });
  }

  $(document).ready(function() {

    $('#pendientes').DataTable({

      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
      },
      select: true,
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


      element.textContent= parseFloat(element.textContent).toFixed(2)

      let importeRealizado =  parseFloat(element.textContent).toFixed(2);



      importeRealizado = importeRealizado.replace(",",".");

      importeRealizado = parseFloat(importeRealizado);

      let importeParseado = importeRealizado.toLocaleString('de-DU', {
        style: 'decimal',
        maximumFractionDigits: 2,
        minimumFractionDigits: 2
      });
      element.textContent = importeParseado

    });





    total = parseNumber(total);
    document.querySelector("#total").textContent = total 

  });






</script>
<link rel="stylesheet" href="css/style.css">

<?php } ?>