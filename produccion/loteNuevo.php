<?php 
session_start(); 
if(!isset($_SESSION['username'])){
	header("Location:login.php");
}else{
?>

<?php include __DIR__."/../Vista/head_0.php";   ?>
<title>Lote nuevo</title>
<?php include __DIR__."/../Vista/head.php";   ?>

    <div class="container mt-3">

        <div>
        
            <form action="loteNuevoPeso.php" method="post">  
                <div class="row">
                
                    <div class="col">
                    </div>
                    <div class="col form-group">
                        <label for="partida">Codigo de gusto:</label>
                        <input type="text" class="form-control" id="gusto" name="tacho">
                    </div>
                    <div class="col">
                    </div>

                </div>
                <div class="row">
                
                    <div class="col">
                    </div>
                    <div class="col form-group">
                        <input type="submit" class="btn btn-primary" value="Pesar">
                    </div>
                    <div class="col">
                    </div>

                </div>
                
                
            </form>

        </div>

        <?php if(isset($_GET['success'])){ ?>
        <div class="row">
        <div class="col"></div>
        <div class="col"></div>
        <div class="col"><button class="btn btn-success" onClick="window.location = 'procesar.php'">Procesar</button></div>
        </div>
        <?php } ?>

    </div>


<?php include __DIR__."/../Vista/footer.php";   ?>
<?php } ?>