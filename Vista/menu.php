<?php
define(  ruta, 'https://www.perlattohelados.com.ar/pedidos__dev/' ) ;
// @define(  ruta, 'https://localhost/perlatto/' ) ;
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
<a href="../inicio.php" class="ml-2"><i class="fa fa-home fa-2x" style="color:black" aria-hidden="true"></i></a>
<i class="fas fa-arrow-alt-circle-left fa-2x ml-3" style="color:black; cursor: pointer" onClick="window.history.back();"></i></a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarNav">
<ul class="navbar-nav">



<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle ml-3" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
Pedidos
</a>
<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
<?php if($_SESSION['tipo']!='ADMIN'){ ?>
<a class="dropdown-item" href="<?=ruta;?>pedidos/index.php">Nuevo Pedido</a>
<a class="dropdown-item" href="<?=ruta;?>pedidos/historial.php">Historial Pedidos</a>
<?php } ?>

<?php if($_SESSION['tipo']!='LOCAL'){ ?>
<a class="dropdown-item" href="<?=ruta;?>pedidos/pendientes.php">Pedidos Abiertos</a>
<a class="dropdown-item" href="<?=ruta;?>pedidos/ordenados.php">Abiertos Ordenados</a>
<a class="dropdown-item" href="<?=ruta;?>pedidos/detalleGustos.php">Abiertos Gustos</a>
<a class="dropdown-item" href="<?=ruta;?>pedidos/todosPedidosGustoLocal.php">Pedidos por gusto por local</a>
<a class="dropdown-item" href="<?=ruta;?>pedidos/todosPedidos.php">Todos los pedidos</a>
<?php } ?>
</div>
</li>

<?php if($_SESSION['tipo']!='LOCAL'){ ?>
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle ml-3" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
Usuarios
</a>
<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
<a class="dropdown-item" href="<?=ruta;?>usuarios/usuarioNuevo.php">Alta</a>
<a class="dropdown-item" href="<?=ruta;?>usuarios/usuarioListar.php" >Ver / Modificar / Elminar</a>
</div>
</li>

<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle ml-3" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
Gustos
</a>
<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
<a class="dropdown-item" href="<?=ruta;?>gustos/gustoNuevo.php">Alta Gusto</a>
<a class="dropdown-item" href="<?=ruta;?>gustos/gustoListar.php">Ver / Modificar / Elminar</a>
</div>
</li>


<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle ml-3" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
Grupos
</a>
<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
<a class="dropdown-item" href="<?=ruta;?>grupos/grupoNuevo.php">Alta Grupo</a>
<a class="dropdown-item" href="<?=ruta;?>grupos/grupoListar.php">Ver / Eliminar</a>
</div>
</li>


<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle ml-3" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
Producción
</a>
<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

<a class="dropdown-item" href="<?=ruta;?>produccion/nuevos.php">Alta Lote</a>
<a class="dropdown-item" href="<?=ruta;?>produccion/stock.php">Stock</a>
</div>
</li>


<?php } ?>



<li class="nav-item dropdown" style="float: right; position: absolute; right: 5px;" id="Divderecha">
<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
Usuario: <?=$_SESSION['username'] ?>
</a>

<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">


<button name="btnCerrarSesion" value="Cerrar Session" class="dropdown-item">
<a href="<?=ruta;?>login.php">Cerrar Session</a>
</button>



</div>
</li>


</ul>
</div>
</nav>