<?php
include __DIR__."/../../Class/Maestro.php";   


$accion = $_GET['accion'];

switch ($accion) {

    case 'agregar':

        agregar();
        break;

    case 'eliminar':

        eliminar();
        break;
    
    case 'actualizar':

        actualizar();
        break;
    
    default:
        # code...
        break;

}





function agregar () {
    
    $maestro = new Maestro();
    $datos = $_POST;

    $result = $maestro->insertarNuevo($datos['descripcion'], $datos['costo']);

    echo $result;

}

function eliminar () {

    $maestro = new Maestro();
    $id = $_POST['id'];

    $result = $maestro->eliminar($id);

    echo $result;
}

function actualizar () {

    $maestro = new Maestro();
    $id = $_POST['id'];
    $descripcion = $_POST['descripcion'];
    $costo = $_POST['costo'];

    $result = $maestro->actualizar($id, $descripcion, $costo);

    echo true;
}

