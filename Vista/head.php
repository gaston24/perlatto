<?php 
require_once(__DIR__.'/../routes.php');
?>

<meta charset="utf-8">
<link rel="shortcut icon" href="<?=$prefijo?>/Imagenes/icono_perlatto.png" />

<!-- BOOTSTRAP -->
<link rel="stylesheet" href="<?=$prefijo?>/assets/bootstrap/bootstrap.min.css" >

<!--  DATATABLES -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.1.5/css/fixedHeader.dataTables.min.css">


<!-- SWEETALERT-->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<body>

<?php if(isset($_SESSION['username'])){ include_once 'menu.php'; }?>    
