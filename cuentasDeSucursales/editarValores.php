<?php 
session_start(); 
if(!isset($_SESSION['username'])){
	header("Location:login.php");
}else{

    include __DIR__."/../Class/maestro.php";   

    $maestro = new Maestro();

    $id = $_GET['id'];
    $data = $maestro->traerPorId($id);

    ?>

    <?php include __DIR__."/../Vista/head_0.php";   ?>
    <title>Editar Valores</title>
    <?php include __DIR__."/../Vista/head.php";   ?>


    <div class="container">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6"><h3>Datos por Editar</h3></div>
            <div class="col-3"></div>
        </div>

        

        <div class="row" >
            <div class="col-3"></div>

            <div class="col-6" >
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="validationDefault01"><h5>Descripcion</h5></label>
                        <input type="text" class="form-control" id="descripcionUpdate" value="<?=$data[0]['descripcion']?>" >
                    </div>
                </div>
            </div>
            
            <div class="col-3"></div>
        </div>
        <div class="row"  >
            <div class="col-3"></div>

            <div class="col-6">
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="validationDefault01"><h5>Costos</h5></label>
                        <input type="text" class="form-control" id="costoUpdate"  value="$<?php echo number_format($data[0]['costo'], 2, ',', '.'); ?>"  onchange="parsearValor(true)">
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
                    <button class="btn btn-primary" onClick="editarValores(<?= $id ?>)">Confirmar</button>
                    </div>
                </div>
            </div>
            
            <div class="col-3"></div>
        </div>
    </div>

    <?php include __DIR__."/../Vista/footer.php";   ?>

    <script src="js/valores.js"></script>
    <link rel="stylesheet" href="css/style.css">

<?php } ?>