<?php

include __DIR__."/../../Class/talonarios.php";
include __DIR__."/../../Class/pedidos.php";
include __DIR__."/../../Class/Mail/enviar.php";


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

// $mail = 'gaston.marcilio@gmail.com';
// enviarMail($mail);

echo $numSiguiente;


?>