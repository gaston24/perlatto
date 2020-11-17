<?php

include __DIR__."/../../Class/pedidos.php";

$tacho = $_POST['tacho'];
$nroPedido = $_POST['nroPedido'];

$partida = substr($tacho, 0, strpos($tacho, 'OP')+3);
$numTacho = substr($tacho, strpos($tacho, 'OP')+4, 2);


$pedido = new Pedido();
$pedido->armarPedidoTachoAux($nroPedido, $partida, $numTacho);

echo $nroPedido.'-'.$partida.'-'.$numTacho;

header('Location: ../armarPedidoTachos.php?nroPedido='.$nroPedido.'&success=ok');

?>