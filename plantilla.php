<?php 
session_start(); 
if(!isset($_SESSION['username'])){
	header("Location:login.php");
}else{
?>

<?php include __DIR__."/../Vista/head_0.php";   ?>
<title>Titulo</title>
<?php include __DIR__."/../Vista/head.php";   ?>

    <div class="container">
    <!-- ESCRIBIR A PARTIR DE ACA -->

    </div>


<?php include __DIR__."/../Vista/footer.php";   ?>
<?php } ?>