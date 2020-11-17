<?php include __DIR__."/Vista/head_0.php";?>
<title>Perlatto - PLANTILLA</title>
<?php include __DIR__."/Vista/head.php";?>


<?php 
include __DIR__."/Class/Mail/enviar.php";

?>

    <div class="container">
    <!-- ESCRIBIR A PARTIR DE ACA -->



    <?php
    
    enviarMail('gaston.marcilio@gmail.com');

    ?>


    </div>

<?php include __DIR__."/Vista/footer.php";?>