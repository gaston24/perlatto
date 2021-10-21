<?php

include __DIR__."/../../Class/talonarios.php";
include __DIR__."/../../Class/pedidos.php";
include __DIR__."/../../Class/usuarios.php";

$usuario = new Usuarios();

$condiciones = $usuario->traerCondiciones();
$arrayCondicion = (array) $condiciones[0];

$cantPedidoTotal = 0;
foreach ($_POST['matriz'] as $key => $value) {
    $cantPedidoTotal += $value[3];
}


if($arrayCondicion['condicion'] == 'MULTIPLO' ){
    if(($cantPedidoTotal%$arrayCondicion['valor'])!=0){
        echo 'ERROR!! Las cantidades total del pedido deben ser multiplo de '.$cantPedidoTotal;
        return;
    }
}elseif($arrayCondicion['condicion'] == 'MINIMO' ){
    if($cantPedidoTotal < $arrayCondicion['valor']){
        echo 'ERROR!! Las cantidades deben tener un minimo de  '.$cantPedidoTotal.' unidades pedidas!';
        return;
    }
}


$detallePedido = $_POST['matriz'];

$sucursal = $_POST['suc'];

$numSig = new Talonario();
$numSiguiente = $numSig->traerUno('PED');
$numSig->actualizarSiguiente('PED');

$pedido = new Pedido();
$pedido->insertarEncabezado($numSiguiente, $sucursal);

$renglon = 1;

foreach ($detallePedido as $key => $value) {
    if($value[3] != 0){
        $pedido->insertarDetalle($sucursal, $numSiguiente, $value[0], $value[3], $renglon);
        $renglon++;
    }
}

echo $numSiguiente;


?>