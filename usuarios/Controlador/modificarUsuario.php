<?php

include __DIR__."/../../Class/usuarios.php";
include __DIR__."/../../Class/locales.php";
include __DIR__."/../../Class/dias.php";

$usuario = new Usuarios();
$local = new Local();
$dia = new Dia();

$datos = $_POST['matrizUsuario'];

$nroLocal = $datos[0];
$descLocal = $datos[1];

$cuit = $datos[2];
$contacto = $datos[3];
$direccion = $datos[4];
$localidad = $datos[5];
$provincia = $datos[6];
$email = $datos[7];
$telefono1 = $datos[8];
$telefono2 = $datos[9];

$user = $datos[10];
$pass = $datos[11];

$estado = $datos[12];


//MODIFICAR USUARIO
$usuario->modificarUserLocal($nroLocal, $user, $pass, $descLocal, $estado);
//MODIFICAR LOCAL
$local->modificarLocal($nroLocal, $descLocal, $direccion, $localidad, $provincia, $contacto, $telefono1, $telefono2, $email, $cuit);


//FECHAS DE ENTREGA 
$dias = $_POST['diasEntrega'];

$lu = $dias[0];
$ma = $dias[1];
$mi = $dias[2];
$ju = $dias[3];
$vi = $dias[4];
$sa = $dias[5];
$do = $dias[6];

$dia->modificarFechaEntrega($nroLocal, $lu, $ma, $mi, $ju, $vi, $sa, $do);

echo $descLocal.' - '.$nroLocal;