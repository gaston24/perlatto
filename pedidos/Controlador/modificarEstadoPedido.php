<?php

include __DIR__."/../../Class/pedidos.php"; 
 

$pedido = new Pedido();


$nroPedido = $_POST['nroPedido'];
$estado = $_POST['estado'];

//MODIFICAR ESTADO
$pedido->modificarEstado($nroPedido, $estado);

echo 'Pedido '.$nroPedido.' modificado';