<?php

include __DIR__."/../../Class/pedidos.php";

$nroPedido = $_POST['nroPedido'];

$pedido = new Pedido();
$pedido->actualizarCantidadesPedidoTacho($nroPedido);
$pedido->insertarTachosPedido($nroPedido);

echo $nroPedido.'-'.$partida.'-'.$numTacho;