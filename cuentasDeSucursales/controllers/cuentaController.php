<?php
include __DIR__."/../../Class/Cuenta.php";   

$cuenta = new Cuenta();

$datos = $_POST;

$result = $cuenta->insertarMovimiento($datos['nroSucursal'],$datos['tipoDeMovimiento'],$datos['cantidad'],$datos['observacion'],$datos['franquiciaFabrica'],$datos['cantidadKilos'],$datos['fecha']);

echo $result;