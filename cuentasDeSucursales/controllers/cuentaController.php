<?php
include __DIR__."/../../Class/Cuenta.php";   

$cuenta = new Cuenta();

$datos = $_POST;

$result = $cuenta->insertarMovimiento($datos['nroSucursal'],$datos['tipoDeMovimiento'],$datos['importe'],$datos['observacion']);

echo $result;