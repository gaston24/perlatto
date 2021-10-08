<?php

include __DIR__."/../../Class/usuarios.php";

$usuario = new Usuarios();

$condiciones = $usuario->traerCondiciones();
$arrayCondicion = (array) $condiciones[0];

echo json_encode($arrayCondicion);