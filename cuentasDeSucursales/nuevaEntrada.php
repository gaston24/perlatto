<?php 
session_start(); 
if(!isset($_SESSION['username'])){
	header("Location:login.php");
}else{

    include __DIR__."/../Class/usuarios.php";
    $usuario = new Usuarios();
    $sigLocal = $usuario->traerSigLocal();

    include __DIR__."/../Class/locales.php";   

    $local = new Local();

    $todosLosLocales = $local->traerLocales();

?>

<?php include __DIR__."/../Vista/head_0.php";   ?>
<title>Nueva Entrada</title>
<?php include __DIR__."/../Vista/head.php";   ?>


<div class="container">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6"><h3>Nuevo Movimiento</h3></div>
        <div class="col-3"></div>
    </div>

    <div class="row">
        <div class="col-3"></div>

        <div class="col-6">
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="validationDefault01"><h5>Sucursal</h5></label>       
                    <select id="nroSucursal">
                        <?php foreach ($todosLosLocales as $key) {?>
                            
                            <option value= "<?= $key['ID_LOCAL'] ?>"><?= $key['LOCAL'] ?></option>

                   
                        <?php } ?>
           
                    </select>
                </div>
            </div>
        </div>
        
        <div class="col-3"></div>
    </div>
    
    <div class="row">
        <div class="col-3"></div>

        <div class="col-6">
            <div class="form-row">
                <div class="col-md-6 mb-3" >
                    <label for="validationDefault01"><h5>Tipo Movimiento</h5></label>
                    <select id="tipoMovimiento">
                        <option value="entrada" >Entrada</option>
                        <option value="salida" >Salida</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-3"></div>
    </div>

    <div class="row">
        <div class="col-3"></div>

        <div class="col-6">
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="validationDefault01"><h5>Importe</h5></label>
                    <input type="text" class="form-control" id="importe" >
                </div>
            </div>
        </div>
        
        <div class="col-3"></div>
    </div>
    <div class="row">
        <div class="col-3"></div>

        <div class="col-6">
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="validationDefault01"><h5>observacion</h5></label>
                    <textarea class="form-control" id="observacion" rows="4"></textarea>
                </div>
            </div>
        </div>
        
        <div class="col-3"></div>
    </div>
    <div class="row">
        <div class="col-3"></div>

        <div class="col-6">
            <div class="form-row">
                <div class="col-md-6 mb-3">
                <button class="btn btn-primary" onClick="MovimientoDeSucursal()">Confirmar</button>
                </div>
            </div>
        </div>
        
        <div class="col-3"></div>
    </div>
</div>

<?php include __DIR__."/../Vista/footer.php";   ?>

<script src="js/main.js"></script>
<link rel="stylesheet" href="css/style.css">

<?php } ?>