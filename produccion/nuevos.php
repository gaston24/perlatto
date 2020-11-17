<?php 
session_start(); 
if(!isset($_SESSION['username'])){
	header("Location:login.php");
}else{
    include __DIR__."/../Class/produccion.php";
 
    $produccion = new Produccion();

    $produccion->limpiarAuxiliar();

    header('Location: loteNuevo.php');

}
