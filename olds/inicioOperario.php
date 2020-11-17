<?php require($_SERVER['DOCUMENT_ROOT']."/perlatto/Vista/head_0.php");   ?>
<title>Perlatto - Bienvenido</title>
<?php require($_SERVER['DOCUMENT_ROOT']."/perlatto/Vista/head.php");   ?>


    <div class="container">
        <div class="row justify-content-center">
            <h1>Bienvenido - Operario</h1>
        </div>

        <div class="row mt-5">
            <div class="col">

                <div class="mt-5">
                <button type="button" class="btn btn-primary btn-lg btn-block" onClick="location.href='partidas'">Nueva Partida</button>
                </div>
                <div class="mt-2">
                <button type="button" class="btn btn-secondary btn-lg btn-block" >Seguimiento de Partidas / Lotes</button>
                </div>
                <div class="mt-2">
                <button type="button" class="btn btn-primary btn-lg btn-block" >Pedidos</button>
                </div>

            
            </div>

            <div class="col float-left mt-3"><img src="Imagenes/logo_perlatto.png"></div>
        </div>

    </div>



<?php require($_SERVER['DOCUMENT_ROOT']."/perlatto/Vista/footer.php");   ?>

