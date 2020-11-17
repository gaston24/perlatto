<?php 

session_start(); 
if(!isset($_SESSION['username'])){
	header("Location:login.php");
}else{

    $user = $_SESSION['username'];
    $nroLocal = $_SESSION['nroSuc'];

    // include __DIR__."/Class/dias.php";
    // $dia = new Dia();

    // $diaArray = $dia->traerProxFechaEntrega($nroLocal);

?>    

<?php include __DIR__."/Vista/head_0.php";   ?>
<title>Perlatto - Bienvenido</title>
<?php include __DIR__."/Vista/head.php";   ?>

</head>

<body>


    <div class="container">
        <div class="row justify-content-center">
            <h1>Bienvenido - <?=$user ?></h1>
        </div>
        <!-- <div class="row justify-content-center">
        <?php //if($_SESSION['tipo']!='ADMIN'){ ?>
            <h3>Proxima entrega: </h3>
        <?php //} ?>    
        </div> -->
            

        <div class="row mt-5">
            <div class="col"></div>
            <div class="col"><img src="Imagenes/logo_perlatto.png"></div>
            <div class="col"></div>
        </div>

    </div>



<?php include __DIR__."/Vista/footer.php";   ?>

<?php } ?>