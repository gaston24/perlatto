<?php 
session_start(); 
if(!isset($_SESSION['username'])){
	header("Location:login.php");
}else{

    $tacho = $_POST['tacho'];
?>

<?php include __DIR__."/../Vista/head_0.php";   ?>
<title>Lote nuevo</title>
<?php include __DIR__."/../Vista/head.php";   ?>

    <div class="container mt-3">

    <form action="Controlador/nuevoTacho.php" method="post">  
            <div class="row">
            
                <div class="col">
                </div>
                <div class="col form-group">
                    <label for="partida">Peso para de gusto:</label>
                    <input type="text" class="form-control" name="peso">
                    <input type="hidden" name="tacho" value="<?=$tacho;?>">
                </div>
                <div class="col">
                </div>

            </div>
            <div class="row">
            
                <div class="col">
                </div>
                <div class="col form-group">
                    <input type="submit" class="btn btn-primary" value="Confirmar" >
                </div>
                <div class="col">
                </div>

            </div>
            
            
        </form>

    </div>


<?php include __DIR__."/../Vista/footer.php";   ?>
<?php } ?>