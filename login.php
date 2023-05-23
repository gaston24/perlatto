<?php
session_start();

if(isset($_SESSION['username'])){
    // echo 'sesion iniciada con '.$_SESSION['username'].'<br>';
    session_destroy();
    // echo 'sesion destruida';
}


?>

<?php include __DIR__."/Vista/head_0.php";   ?>
<title>Perlatto - Ingrese</title>
<meta charset="utf-8">
<link rel="shortcut icon" href="../../perlatto/Imagenes/icono_perlatto.png" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<body>


    <div class="container">
        <div class="row justify-content-center">
            <h1>INGRESO AL SISTEMA</h1>
        </div>

        <div class="row mt-5">
            <div class="col">

                <div>
                    <form action="./validar.php" method="post">
                        <div class="row">
                            <div class="col-6">
                            </div>
                            <div class="col-6 mt-5">
                            <label for="usuario">Nombre de usuario</label>
                            <input type="text" class="form-control" name="user" aria-describedby="emailHelp">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6">
                            </div>
                            <div class="col-6">
                            <label for="pass">Contraseña</label>
                            <input type="password" class="form-control" name="pass" aria-describedby="emailHelp">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6">
                            </div>
                            <div class="col-6">
                            <button class="btn btn-primary" >Ingresar</button>
                            </div>
                        </div>
                    
                    </form>
                </div>
            
            </div>

            <div class="col float-left mt-3"><img src="Imagenes/logo_perlatto.png"></div>
        </div>

    </div>


<?php if(isset( $_COOKIE["error"]) && $_COOKIE["error"] != null ){ echo $_COOKIE['error'];?>

<script> swal("Error!", "Usuario o contraseña invalida!", "error"); </script>
    
<?php 

setcookie("error", null); 
} ?>


<?php include __DIR__."/Vista/footer.php";   ?>

