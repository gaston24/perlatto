<?php 
session_start(); 
if(!isset($_SESSION['username'])){
	header("Location:login.php");
}else{

    include __DIR__."/../Class/usuarios.php";
    $usuario = new Usuarios();

    $sigLocal = $usuario->traerSigLocal();

?>

<?php include __DIR__."/../Vista/head_0.php";   ?>
<title>Nuevo Usuario</title>
<?php include __DIR__."/../Vista/head.php";   ?>


    <div class="container">
    <!-- ESCRIBIR A PARTIR DE ACA -->

<div class="row">
<div class="col"></div>
<div class="col"><h3>Alta Usuario/Local Nuevo</h3></div>
<div class="col"></div>
</div>


  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="validationDefault01">Nro Local</label>
      <input type="text" class="form-control" id="nroLocal" value="<?=$sigLocal?>" readonly>
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationDefault02">Descripcion Local</label>
      <input type="text" class="form-control" id="descLocal" required>
    </div>
  </div>
  <div class="form-row">
  <div class="col-md-6 mb-3">
      <label for="validationDefault01">CUIT</label>
      <input type="text" class="form-control" id="cuit" >
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationDefault02">Nombre Contacto</label>
      <input type="text" class="form-control" id="nombreContacto" required>
    </div>
  </div>
  <div class="form-row">
  <div class="col-md-4 mb-3">
      <label for="validationDefault01">Direccion</label>
      <input type="text" class="form-control" id="direccion" required>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault01">Localidad</label>
      <input type="text" class="form-control" id="localidad" required>

    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault01">Provincia</label>
      <input type="text" class="form-control" id="provincia" required>

    </div>
  </div>
  
  
  <div class="form-row">
  <div class="col-md-4 mb-3">
      <label for="validationDefault01">Email</label>
      <input type="email" class="form-control" id="email" required>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault02">Telefono</label>
      <input type="text" class="form-control" id="telefono1" required>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault02">Telefono 2</label>
      <input type="text" class="form-control" id="telefono2" >
    </div>

  </div>

  <div class="form-row mb-2 mt-2">
  <label for="validationDefault01" class="mr-3">Dias de entrega:</label>

    <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" name="dias" id="chkLunes" value="lunes">
      <label class="form-check-label" for="chkLunes">Lunes</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" name="dias" id="chkMartes" value="martes">
      <label class="form-check-label" for="chkMartes">Martes</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" name="dias" id="chkMiercoles" value="miercoles">
      <label class="form-check-label" for="chkMiercoles">Miercoles</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" name="dias" id="chkJueves" value="jueves">
      <label class="form-check-label" for="chkJueves">Jueves</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" name="dias" id="chkViernes" value="viernes">
      <label class="form-check-label" for="chkViernes">Viernes</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" name="dias" id="chkSabado" value="sabado">
      <label class="form-check-label" for="chkSabado">Sabado</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" name="dias" id="chkDomingo" value="domingo">
      <label class="form-check-label" for="chkDomingo">Domingo</label>
    </div>

  </div>
  
	<div class="form-row">
	
		<div class="col-md-4 mb-3">
		    <button class="btn btn-primary" onClick="newUser()">Agregar Usuario</button>
		</div>
		<div class="col-md-8 mb-3 border border-dark">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="validationDefault01">Usuario</label>
                    <input type="text" class="form-control" id="user" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationDefault02">Contraseña</label>
                    <input type="text" class="form-control" id="pass" required>
                </div>
            </div>
		</div>


	
	</div>
  


    </div>

<?php include __DIR__."/../Vista/footer.php";   ?>

<script src="Controlador/main.js"></script>

<?php } ?>