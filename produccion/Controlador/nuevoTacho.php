<?php 
session_start(); 
if(!isset($_SESSION['username'])){
	header("Location:login.php");
}else{
    include __DIR__."/../../Class/produccion.php";

    $tacho = $_POST['tacho'];
    $peso = str_replace(',', '.', $_POST['peso']);

    if(strlen($tacho)<15){
        header('Location: ../loteNuevo.php');
    }elseif(strlen($peso)>6 || $peso > 15 || $peso < 3){
        header('Location: ../loteNuevo.php');
    }else{

        $fecha = substr($tacho, 0, 4).'-'.substr($tacho, 4, 2).'-'.substr($tacho, 6, 2);
        $numPartida = substr($tacho, 8, 2);
        $codGusto = substr($tacho, 10, strpos($tacho, 'OP')-10);
        $operario = substr($tacho, strpos($tacho, 'OP'), 3);
        $partida = substr($tacho, 0, strpos($tacho, 'OP')+3);
        $numTacho = substr($tacho, strpos($tacho, 'OP')+4, 2);
        
        $produccion = new Produccion();

        $produccion->insertarAuxiliar($codGusto, $fecha, $partida, $numPartida, $operario, $peso, $numTacho);

        header('Location: ../loteNuevo.php?success=ok');

    }

    // echo $codGusto.'-'.$peso;

    

    // echo 'fecha: '.$fecha.'<br>';
    // echo 'partida: '.$partida.'<br>';
    // echo 'num dia: '.$numPartida.'<br>';
    // echo 'codigo: '.$codGusto.'<br>';
    // echo 'operario: '.$operario.'<br>';
    // echo 'tacho: '.$numTacho.'<br>';
    // echo 'peso: '.$peso.'<br>';
    




    
}
