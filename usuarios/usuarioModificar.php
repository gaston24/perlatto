<?php 
session_start(); 
if(!isset($_SESSION['username'])){
	header("Location:login.php");
}else{

    include __DIR__."/../Class/usuarios.php";
    include __DIR__."/../Class/dias.php";
    $nroLocalTraer = $_GET['nro'];

    $usuario = new Usuarios();
    $listado = $usuario->traerPorNum($nroLocalTraer);
    
    $dia = new Dia();
    $dias = $dia->traerPorNumDiasEntrega($nroLocalTraer);

?>

<?php include __DIR__."/../Vista/head_0.php";   ?>
<title>Modificar Usuario</title>
<?php include __DIR__."/../Vista/head.php";   ?>

    <div class="container">
    <!-- ESCRIBIR A PARTIR DE ACA -->

<div class="row">
<div class="col"></div>
<div class="col"><h3>Modificar Usuario/Local</h3></div>
<div class="col"></div>
</div>

<?php
foreach ($listado as $key => $local) {
?>



  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="validationDefault01">Nro Local</label>
      <input type="text" class="form-control" id="nroLocal" value="<?=$local->NRO_LOCAL?>" readonly>
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationDefault02">Descripcion Local</label>
      <input type="text" class="form-control" id="descLocal" value="<?=$local->LOCAL?>">
    </div>
  </div>
  <div class="form-row">
  <div class="col-md-6 mb-3">
      <label for="validationDefault01">CUIT</label>
      <input type="text" class="form-control" id="cuit" value="<?=$local->CUIT?>" >
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationDefault02">Nombre Contacto</label>
      <input type="text" class="form-control" id="nombreContacto"  value="<?=$local->CONTACTO?>">
    </div>
  </div>
  <div class="form-row">
  <div class="col-md-4 mb-3">
      <label for="validationDefault01">Direccion</label>
      <input type="text" class="form-control" id="direccion"  value="<?=$local->DIRECCION?>">
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault01">Localidad</label>
      <input type="text" class="form-control" id="localidad"  value="<?=$local->LOCALIDAD?>">

    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault01">Provincia</label>
      <input type="text" class="form-control" id="provincia"  value="<?=$local->PROVINCIA?>">

    </div>
  </div>
  
  
  <div class="form-row">
  <div class="col-md-4 mb-3">
      <label for="validationDefault01">Email</label>
      <input type="email" class="form-control" id="email"  value="<?=$local->EMAIL?>">
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault02">Telefono</label>
      <input type="text" class="form-control" id="telefono1"  value="<?=$local->TELEFONO_1?>">
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault02">Telefono 2</label>
      <input type="text" class="form-control" id="telefono2" value="<?=$local->TELEFONO_2?>">
    </div>

  </div>

  <?php
  foreach ($dias as $key => $value) {
  ?>  
      
    
  <div class="form-row mb-2 mt-2">
  <label for="validationDefault01" class="mr-3">Dias de entrega:</label>

    <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" name="dias" id="chkLunes" value="lunes" <?php if($value->LUNES == 1){echo 'checked';} ?> >
      <label class="form-check-label" for="chkLunes">Lunes</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" name="dias" id="chkMartes" value="martes" <?php if($value->MARTES == 1){echo 'checked';} ?> >
      <label class="form-check-label" for="chkMartes">Martes</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" name="dias" id="chkMiercoles" value="miercoles" <?php if($value->MIERCOLES == 1){echo 'checked';} ?> >
      <label class="form-check-label" for="chkMiercoles">Miercoles</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" name="dias" id="chkJueves" value="jueves" <?php if($value->JUEVES == 1){echo 'checked';} ?> >
      <label class="form-check-label" for="chkJueves">Jueves</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" name="dias" id="chkViernes" value="viernes" <?php if($value->VIERNES == 1){echo 'checked';} ?> >
      <label class="form-check-label" for="chkViernes">Viernes</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" name="dias" id="chkSabado" value="sabado" <?php if($value->SABADO == 1){echo 'checked';} ?> >
      <label class="form-check-label" for="chkSabado">Sabado</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" name="dias" id="chkDomingo" value="domingo" <?php if($value->DOMINGO == 1){echo 'checked';} ?> >
      <label class="form-check-label" for="chkDomingo">Domingo</label>
    </div>

  </div>
  <?php
  }
  ?>


  
	<div class="form-row">
	
		<div class="col-md-4 mb-3">
      <div class="row">
        <div class="col">
          <button class="btn btn-primary" onClick="modUser()">Modificar Usuario</button>
        </div>
        
      </div>
		</div>
		<div class="col-md-8 mb-3 border border-dark">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="validationDefault01">Usuario</label>
                    <input type="text" class="form-control" id="user"  value="<?=$local->NAME?>">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationDefault02">Contraseña</label>
                    <input type="text" class="form-control" id="pass"  value="<?=$local->PASS?>">
                </div>
                <div class="col-md-4 mb-3">
                <label for="exampleFormControlSelect1">Estado</label>
                <select class="form-control" id="estado">
                  <option value="1" <?php if($local->ESTADO==1){echo 'selected';} ?> >Habilitado</option>
                  <option value="0" <?php if($local->ESTADO==0){echo 'selected';} ?> >Deshabilitado</option>
                </select>
              </div>
            </div>
		</div>


	
  </div>
  
  <?php
}
?>
  


    </div>

<?php include __DIR__."/../Vista/footer.php";   ?>

<script src="Controlador/main.js"></script>

<?php } ?>