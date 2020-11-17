<?php 
session_start(); 
if(!isset($_SESSION['username'])){
	header("Location:login.php");
}else{

    
    
    
?>
<?php include __DIR__."/../Vista/head_0.php";   ?>
<title>Nuevo Grupo</title>
<?php include __DIR__."/../Vista/head.php";   ?>

    <div class="container">
    <!-- ESCRIBIR A PARTIR DE ACA -->

<div class="row">
<div class="col"></div>
<div class="col"><h3>Alta Grupo Nuevo</h3></div>
<div class="col"></div>
</div>


  <div class="form-row mt-5">
    <div class="col-md-6 mb-3">
      <label for="validationDefault01">Cod Grupo</label>
      <input type="text" class="form-control" id="codGrupo" >
    </div>

    <div class="col-md-6 mb-3">
      <label for="validationDefault02">Descripcion Grupo</label>
      <input type="text" class="form-control" id="descGrupo" required>
    </div>
  </div>
   
	<div class="form-row">
	
		<div class="col-md-4 mb-3">
		    <button class="btn btn-primary" onClick="newGrupo()">Agregar Grupo</button>
		</div>
	

	
	</div>
  


    </div>

<?php include __DIR__."/../Vista/footer.php";   ?>
<script src="Controlador/mainGrupos.js"></script>

<?php } ?>