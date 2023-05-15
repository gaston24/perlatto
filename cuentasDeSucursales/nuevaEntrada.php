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
                    <?php
                        if ($_GET['tipoMovimiento'] == 0) {
                    ?>

                            <select id="tipoMovimiento">
                                <option value="entrada" >Entrada</option>
                                <option value="salida" >Salida</option>
                            </select>

                    <?php 
                        }else {
                    ?>
                            <select id="tipoMovimiento" onchange="comprobarTacho()">
                                <option value="salida_tachos" >salida Tachos de Helado</option>
                                <option value="salida_bolsas_grandes" >salida Bolsas Grandes</option>
                                <option value="salida_bolsas_chicas" >Salida Bolsas Chicas</option>
                                <option value="salida_chombas" >Salida Chombas</option>
                                <option value="salida_delantal" >Salida Delantales</option>
                                <option value="salida_termicos" >Salida Termicos</option>
                                <option value="salida_gorras" >Salida Gorras</option>
                                <option value="salida_salsas" >Salida Salsas</option>
                                <option value="salida_cucuruchos" >Salida Cucuruchos</option>
                                <option value="salida_cintas" >Salida Cintas</option>
                            </select>   

                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>

        <div class="col-3"></div>
    </div>

    <div class="row" id="divCantidadTachos">
        <div class="col-3"></div>

        <div class="col-6" >
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="validationDefault01"><h5>Cantidad de Tachos</h5></label>
                    <input type="text" class="form-control" id="cantidadTachos" >
                </div>
            </div>
        </div>
        
        <div class="col-3"></div>
    </div>
    <div class="row" id="divCantidadKilos" >
        <div class="col-3"></div>

        <div class="col-6">
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="validationDefault01"><h5>Cantidad de Kilos</h5></label>
                    <input type="text" class="form-control" id="cantidadKilos" >
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
                <button class="btn btn-primary" onClick="MovimientoDeSucursal(<?= $_GET['tipoMovimiento']?>)">Confirmar</button>
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