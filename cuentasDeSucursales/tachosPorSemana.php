<?php 

session_start(); 

if(!isset($_SESSION['username']) || $_SESSION['tipo'] != "ADMIN"){
	header("Location:login.php");
}else{

    $user = $_SESSION['username'];
    $suc = $_SESSION['nroSuc'];

    // Se carga el siguiente archivo donde se encuentra la logica aplicada a los datos que llegan de la db
    require_once "cargaDatosTachosPorSemana.php"


?> 
<?php include __DIR__."/../Vista/head_0.php";   ?>
    <title>Perlatto - Tachos-Por-Semana</title>
<?php include __DIR__."/../Vista/head.php";   ?>

<div class="container mt-2 mb-2" style="background-color:white">

    <div class="row">
        <div class="col" style="margin-bottom: 5rem;"  id="a"></div>
    </div>
    <div class="row">
        <div class="col"></div>
        <div class="col"><h3>Cuentas Por Semana</h3></div>
        <div class="col"></div>
    </div>
    <form action="" style="margin-left:300px">
        <div id="anio">
        <label ><h4> Filtro por Fecha </h4></label>
            
            <label > Año :</label> 
            <select name="anio" id="selectAño">
                <?php 
                    for ($i=0; $i <= $yearDif ; $i++) { 
                        $y = 2023 + $i;
                ?>
                    <option value="<?=$y?>"><?=$y?></option>
                        <!-- # code... -->
                <?php
                    }
                ?>

            </select>
            <label> Mes :</label>
           <select name="mes" id="selectMes">
               
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                  

            </select>
            
            
            <button type="submit" class="btn btn-primary" style="margin-left:10px">confirmar</button>
            
            
        </div>
    </form>    
    <!-- ESCRIBIR A PARTIR DE ACA -->

    <?php
    foreach ($tiposMov as $key => $value) {

          $tituloTipoMov =  explode("_",$key);
          $titulo = ""; 
          foreach ($tituloTipoMov  as $palabra) {
            $titulo .= strtoupper($palabra)." ";
          }
        ?>
    <div style="margin-bottom:30px"><h4><?= $titulo ?></h4></div>
    <table class="table table-striped table-bordered" style="margin-left:30px;margin-bottom:100px" id="tablaDatos">
        <thead>
            <tr>
                <th scope="col">LOCAL</th>
                <th style="text-align:center"><div>Semana 1</div><div>(1-7)</div></th>
                <th style="text-align:center"><div>Semana 2</div><div>(8-14)</div></th>
                <th style="text-align:center"><div>Semana 3</div><div>(15-21)</div></th>
                <th style="text-align:center"><div>Semana 4</div><div>(22-28)</div></th>
                <th style="text-align:center"><div>Semana 5</div><div>(29-31)</div></th>
                <?php if($key == "salida_tachos") {?>
                    <th style="text-align:center;background-color:grey" ><div>Valorizado</div><div></div></th>
                    <th style="text-align:center;background-color:#2eb5b7" ><div>Resto</div><div></div></th>
                    <th style="text-align:center;background-color:#4b9c12" ><div>Total</div><div></div></th>
                <?php }?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($value as $k => $val) {

                    if($key == "salida_tachos"){
                        $total =0;
                        $total += (isset($semanas[0])) ? $val[$semanas[0]]['importe'] : 0 ;
                        $total += (isset($semanas[1])) ? $val[$semanas[1]]['importe'] : 0 ;
                        $total += (isset($semanas[2])) ? $val[$semanas[2]]['importe'] : 0 ;
                        $total += (isset($semanas[3])) ? $val[$semanas[3]]['importe'] : 0 ;
                        $total += (isset($semanas[4])) ? $val[$semanas[4]]['importe'] : 0 ;
                    
                    ?>
            <tr>
                <td><a href="detalleTachos.php?idSucursal=<?= $val['id_local'] ?>&nombreSucursal=<?=$k ?>&fecha=<?= $currentDate ?>&tipoMov=<?= $key ?>"><?=$k ?></a></td>

                <td style="text-align:center"  attr-realValue ="0" ><?= (isset($semanas[0])) ? $val[$semanas[0]]['cantidad_kilos'] : 0 ?> kg (<?= (isset($semanas[0])) ? $val[$semanas[0]]['cantidad'] : 0 ?>)</td>
                <td style="text-align:center"  attr-realValue ="0" ><?= (isset($semanas[1])) ? $val[$semanas[1]]['cantidad_kilos'] : 0 ?> kg (<?= (isset($semanas[1])) ? $val[$semanas[1]]['cantidad'] : 0 ?>)</td>
                <td style="text-align:center"  attr-realValue ="0" ><?= (isset($semanas[2])) ? $val[$semanas[2]]['cantidad_kilos'] : 0 ?> kg (<?= (isset($semanas[2])) ? $val[$semanas[2]]['cantidad'] : 0 ?>)</td>
                <td style="text-align:center"  attr-realValue ="0" ><?= (isset($semanas[3])) ? $val[$semanas[3]]['cantidad_kilos'] : 0 ?> kg (<?= (isset($semanas[3])) ? $val[$semanas[3]]['cantidad'] : 0 ?>)</td>
                <td style="text-align:center"  attr-realValue ="0" ><?= (isset($semanas[4])) ? $val[$semanas[4]]['cantidad_kilos'] : 0 ?> kg (<?= (isset($semanas[4])) ? $val[$semanas[4]]['cantidad'] : 0 ?>)</td>
                <td style="text-align:center"  attr-realValue ="0" >$<?= $total ?></td>
                <td style="text-align:center"  attr-realValue ="0"  id="totalResto"><?= 0 ?></td>
                <td style="text-align:center"  attr-realValue ="0"  ><?= 0 ?></td>
      
                
            </tr>
            <?php 
                }else{

                ?>
            <tr>  
                <td><a href="detalleTachos.php?idSucursal=<?= $val['id_local'] ?>&nombreSucursal=<?=$k ?>&fecha=<?= $currentDate ?>&tipoMov=<?= $key ?>"><?=$k ?></a></td>
                <td style="text-align:center" id="totalSemana1" attr-realValue = "<?= (isset($semanas[0])) ? $val[$semanas[0]]['importe'] : 0  ?>"><?= (isset($semanas[0])) ? $val[$semanas[0]]['cantidad'] : 0 ?> ($<?= (isset($semanas[0])) ? number_format($val[$semanas[0]]['importe'], 2, ',', '.') : 0 ?>)</td>
                <td style="text-align:center" id="totalSemana2" attr-realValue = "<?= (isset($semanas[1])) ? $val[$semanas[1]]['importe'] : 0  ?>"><?= (isset($semanas[1])) ? $val[$semanas[1]]['cantidad'] : 0 ?> ($<?= (isset($semanas[1])) ? number_format($val[$semanas[1]]['importe'], 2, ',', '.') : 0 ?>)</td>
                <td style="text-align:center" id="totalSemana3" attr-realValue = "<?= (isset($semanas[2])) ? $val[$semanas[2]]['importe'] : 0  ?>"><?= (isset($semanas[2])) ? $val[$semanas[2]]['cantidad'] : 0 ?> ($<?= (isset($semanas[2])) ? number_format($val[$semanas[2]]['importe'], 2, ',', '.')  : 0 ?>)</td>
                <td style="text-align:center" id="totalSemana4" attr-realValue = "<?= (isset($semanas[3])) ? $val[$semanas[3]]['importe'] : 0  ?>"><?= (isset($semanas[3])) ? $val[$semanas[3]]['cantidad'] : 0 ?> ($<?= (isset($semanas[3])) ? number_format($val[$semanas[3]]['importe'], 2, ',', '.')  : 0 ?>)</td>
                <td style="text-align:center" id="totalSemana5" attr-realValue = "<?= (isset($semanas[4])) ? $val[$semanas[4]]['importe'] : 0  ?>"><?= (isset($semanas[4])) ? $val[$semanas[4]]['cantidad'] : 0 ?> ($<?= (isset($semanas[4])) ? number_format($val[$semanas[4]]['importe'], 2, ',', '.')  : 0 ?>)</td>

            </tr>
                <?php
                }

            } ?>
        </tbody>
    </table>        
    <?php
    

    }

    ?>

</div>

<?php include __DIR__."/../Vista/footer.php";   ?>

<script src="js/listadoPorSemana.js"></script>
<link rel="stylesheet" href="css/style.css">

<?php } ?>