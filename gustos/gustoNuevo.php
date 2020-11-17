<?php 
session_start(); 
if(!isset($_SESSION['username'])){
	header("Location:login.php");
}else{
include __DIR__."/../Class/grupos.php";
$grupo = new Grupo();
$list = $grupo->traerTodos();
    
    
?>
<?php include __DIR__."/../Vista/head_0.php";   ?>
<title>Nuevo Gusto</title>
<?php include __DIR__."/../Vista/head.php";   ?>

    <div class="container">
    <!-- ESCRIBIR A PARTIR DE ACA -->

<div class="row">
<div class="col"></div>
<div class="col"><h3>Alta Gusto Nuevo</h3></div>
<div class="col"></div>
</div>


  <div class="form-row mt-5">

    <div class="col-md-4 mb-3">
      <label for="validationDefault02">Grupo</label>
      <select class="form-control" id="codGrupo">
      <?php
        foreach ($list as $key => $value) {
      ?>  
      <option value="<?=$value->COD_GRUPO?>"><?=$value->COD_GRUPO?> - <?=$value->DESC_GRUPO?></option>
      <?php
        }
      ?>  

      </select>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault01">Codigo</label>
      <input type="text" class="form-control" id="codGusto" >
    </div>
    
    <div class="col-md-4 mb-3">
      <label for="validationDefault02">Descripcion</label>
      <input type="text" class="form-control" id="descGusto" required>
    </div>
  </div>
   
	<div class="form-row">
	
		<div class="col-md-4 mb-3">
		    <button class="btn btn-primary" onClick="newGusto()">Agregar Gusto</button>
		</div>
	

	
	</div>
  


    </div>

<?php include __DIR__."/../Vista/footer.php";   ?>

<script src="Controlador/main.js"></script>

<?php } ?>