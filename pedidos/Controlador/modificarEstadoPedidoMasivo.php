<?php

include __DIR__."/../../Class/pedidos.php"; 
 

$pedido = new Pedido();


$pedidos = $_POST['pedidos'];
$estado = $_POST['estado'];

foreach ($pedidos as $key => $value) {
    $pedido->modificarEstado($value, $estado);
    if($estado == 3){
        $pedido->actualizarCantidad($value);
    }
    echo $value.' - ';
}


