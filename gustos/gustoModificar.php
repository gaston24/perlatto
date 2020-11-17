<?php 
session_start(); 
if(!isset($_SESSION['username'])){
	header("Location:login.php");
}else{

include __DIR__."/../Class/grupos.php";    
include __DIR__."/../Class/gustos.php";    

$grupo = new Grupo();
$gusto = new Gusto();
$codGusto = $_GET['cod'];
$list = $gusto->traerUno($codGusto);
$list2 = $grupo->traerTodos();

    
?>
<?php include __DIR__."/../Vista/head_0.php"; ?>   
<title>Modificar Gusto</title>
<?php include __DIR__."/../Vista/head.php"; ?>   


    <div class="container">
    <!-- ESCRIBIR A PARTIR DE ACA -->

<div class="row">
<div class="col"></div>
<div class="col"><h3>Modificar Gusto</h3></div>
<div class="col"></div>
</div>


<?php
        foreach ($list as $key => $value) {
?>  

  <div class="form-row mt-5">

    <div class="col-md-4 mb-3">
      <label for="validationDefault02">Grupo</label>
      <select class="form-control" id="codGrupo">
      <?php
        foreach ($list2 as $key => $value2) {
      ?>  
      <option value="<?=$value2->COD_GRUPO?>" <?php if($value2->COD_GRUPO == $value->GRUPO){echo 'selected';} ?> ><?=$value2->COD_GRUPO?> - <?=$value2->DESC_GRUPO?></option>
      <?php
        }
      ?>  

      </select>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault01">Codigo</label>
      <input type="text" class="form-control" id="codGusto" value="<?=$value->COD_GUSTO?>">
    </div>
    
    <div class="col-md-4 mb-3">
      <label for="validationDefault02">Descripcion</label>
      <input type="text" class="form-control" id="descGusto" value="<?=$value->DESC_GUSTO?>">
    </div>
  </div>


  <div class="form-row mt-5">

    <div class="col-md-4 mb-3">
      <label for="validationDefault02">Estado</label>
      <select class="form-control" id="estado">
        <option value="1" <?php if ($value->ESTADO == 1){echo 'selected';}?> >Habilitado</option>
        <option value="0" <?php if ($value->ESTADO == 0){echo 'selected';}?> >Deshabilitado</option>
      </select>
    </div>
  </div>






   
	<div class="form-row">
	
		<div class="col-md-4 mb-3">
		    <button class="btn btn-primary" onClick="modGusto('<?=$codGusto?>')">Modificar Gusto</button>
		</div>
	

	
	</div>
  
  <?php } ?>


    </div>


<?php include __DIR__."/../Vista/footer.php"; ?>   
<script src="Controlador/main.js"></script>



<?php } ?>