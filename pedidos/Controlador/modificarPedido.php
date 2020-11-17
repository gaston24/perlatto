<?php

include __DIR__."/../../Class/pedidos.php"; 
 

$pedido = new Pedido();


$nroPedido = $_POST['nroPedido'];
$estado = $_POST['estado'];
$matriz = $_POST['matriz'];

//MODIFICAR ESTADO
$pedido->modificarEstado($nroPedido, $estado);

//MODIFICAR CANTIDADES
foreach ($matriz as $key => $value) {
    if($value[6] != 0){
        // $pedido->insertarDetalle($sucursal, $numSiguiente, $value[0], $value[3], $renglon);
        $pedido->actualizarCantidades($nroPedido, $value[3], $value[6]);
    }
}

echo 'Pedido '.$nroPedido.' modificado';