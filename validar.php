<?php

// require($_SERVER['DOCUMENT_ROOT']."/perlatto/Class/usuarios.php"); 
include __DIR__."/Class/usuarios.php";

$user = new Usuarios();

$u = $_POST['user'];
$p = $_POST['pass'];



if( $user->login($u, $p) == 1 ){
    session_start();
    $logueado = $user->traerUno($u, $p);
    foreach ($logueado as $key => $value) {
        $_SESSION['username'] = $value->DESCRIPCION;
        $_SESSION['nroSuc'] = $value->NRO_LOCAL;
        $_SESSION['tipo'] = $value->TIPO;
    }
    header('Location: inicio.php');
}else{
    setcookie("error", 'Usuario o contraseña invalida');
    header('Location: login.php');
}
