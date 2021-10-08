<?php

include __DIR__."/../../Class/usuarios.php";


$usuario = new Usuarios();

$datos = $_POST['matrizUsuario'];
$condicion = $_POST['condicion'];

$user = $datos[10];
$pass = $datos[11];

$multiplo = $condicion[0];
$minimo = $condicion[1];
$valor = $condicion[2];



//MODIFICAR USUARIO
$usuario->modificarUserLocal(0, $user, $pass, 'ADMINISTRADOR', 1);

//MODIFICAR CONDICION DE PEDIDOS
$usuario->modificarCondicion($multiplo, $minimo, $valor);

echo '0 - Administrador';